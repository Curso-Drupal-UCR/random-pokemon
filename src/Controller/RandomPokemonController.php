<?php

/**
 * @file
 * RandomPokemonController
 */

namespace Drupal\random_pokemon\Controller;

use Drupal\Core\Controller\ControllerBase;

class RandomPokemonController extends ControllerBase
{
  public function getRandomPokemon()
  {
    $urlApi = 'https://pokeapi.co/api/v2/pokemon/';

    $html = '';

    for ($i = 0; $i < 5; $i++) {
      $pokeId = rand(1, 721);
      $pokeUrl = $urlApi . $pokeId;

      $data = file_get_contents($pokeUrl);
      $data = json_decode($data, TRUE);

      $pokeName = ucfirst($data['name']);
      $pokeImage = $data['sprites']['other']['home']['front_default'];

      $html .= "<div class='col-12 col-sm-6 col-md-4 col-lg-3'>
        <img height='200' width='200' class='img-fluid rounded img-thumbnail' alt='$pokeName' src='$pokeImage' />
        <h3 class='text-center'>$pokeName</h3>
      </div>";
    }

    return [
      '#type' => 'markup',
      '#markup' => $this->t('
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="d-flex flex-wrap">
                ' . $html . '
              </div>
            </div>
          </div>
        </div>
      '),
    ];
  }

  public function getPokemon($pokemon)
  {
    $urlApi = "https://pokeapi.co/api/v2/pokemon/$pokemon";

    return [
      '#type' => 'markup',
      '#markup' => $urlApi,
    ];
  }
}
