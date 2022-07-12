<?php

/**
 * @file
 * RandomPokemonBlock.
 */

namespace Drupal\random_pokemon\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'RandomPokemonBlock' block.
 *
 * @Block(
 *  id = "random_pokemon_block",
 *  admin_label = @Translation("Random Pokemon block"),
 *  category = @Translation("Random Pokemon"),
 * )
 */

class RandomPokemonBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   */
  public function build()
  {
    $pokeId = rand(1, 721);
    $pokeUrl = "https://pokeapi.co/api/v2/pokemon/$pokeId";


    $data = file_get_contents($pokeUrl);
    $data = json_decode($data, TRUE);

    $pokeName = ucfirst($data['name']);
    $pokeImage = $data['sprites']['other']['home']['front_default'];

    $html = "<div>
        <img height='200' width='200' class='img-fluid rounded img-thumbnail' alt='$pokeName' src='$pokeImage' />
        <h3>$pokeName</h3>
      </div>";

    return [
      '#type' => 'markup',
      '#markup' => $this->t('
        <div class="d-flex justify-content-center text-center align-items-center flex-column">
          ' . $html . '
          <a href="/random-pokemon" title="Get more pokemon">
            <img height="80" width="80" src="https://proxy.duckduckgo.com/iu/?u=https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Pokebola-pokeball-png-0.png/481px-Pokebola-pokeball-png-0.png&f=1" alt="pokebola" />
          </a>
        </div>
        <form action="/pokemon" method="GET">
          <input name="pokemon" type="text" value="" placeholder="Add pokemon name" />
          <button type="submit" class="btn btn-primary">Get pokemon</button>
        </form>
      '),
    ];
  }
}
