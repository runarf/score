<?php
/*
Plugin Name: RF score
Plugin URI:
Description: Show score on website
Version: 2.0
Author: Runar Flåten
Author URI: runar.xyz
License: GPLv2
*/

add_action( 'admin_enqueue_scripts', 'rfscore_enqueue_scripts' );

function rfscore_enqueue_scripts() {
  wp_register_script( 'rfscore-script', plugins_url( '/js/goalscorer.js', __FILE__), array('jquery'), true);

  wp_enqueue_script( 'rfscore-script' );
}

add_action( 'add_meta_boxes', 'rfscore_register_meta_box');

function rfscore_register_meta_box() {
  add_meta_box(
    'rf-score-meta',
    'Score',
    'rf_score_meta_box',
    'post',
    'side',
    'high'
  );

  add_meta_box(
    'rf-goals-meta',
    'Goals',
    'rf_goals_meta_box',
    'post',
    'side',
    'high'
  );
}

function rf_score_meta_box() {
  global $post;
  $values = get_post_custom(
    $post->ID
  );
  $score_home = isset( $values['score_home']) ? $values['score_home'][0] : '';
  $score_away = isset( $values['score_away']) ? $values['score_away'][0] : '';
  wp_nonce_field( 'meta-box-save', 'rfscore-plugin' );

  ?>
  <label for="score_home">Score home team</label>
  <input type="text" name="score_home" value="<?php echo $score_home ?>">
  <label for="score_away">Score away team</label>
  <input type="text" name="score_away" value="<?php echo $score_away ?>">
  <?php
}

add_action( 'save_post', 'rf_score_save_data' );

function rf_score_save_data( $post_id) {
  if ( get_post_type( $post_id ) == 'post') {
    if ( defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
      return;
    }
    if( !current_user_can( 'edit_post', $post_id ) ) return;

    wp_verify_nonce( 'meta-box-save', 'rfscore-plugin' );

    if ( isset ($_POST['score_home'])) {
      update_post_meta( $post_id, 'score_home', absint($_POST['score_home']));
    }
    if ( isset ($_POST['score_away'])) {
      update_post_meta( $post_id, 'score_away', absint($_POST['score_away']));
    }
    $i = 1;
    while( isset ($_POST['goal_min' . $i])){
      update_post_meta( $post_id, 'goal_min' . $i, absint($_POST['goal_min' . $i]));
      update_post_meta( $post_id, 'goal_name' . $i, esc_attr($_POST['goal_name' . $i]));
      $home = 0;
      if ( isset( $_POST['goal_home' . $i]) && $_POST['goal_home' . $i] == True) {
        $home = 1;
      }
      update_post_meta( $post_id, 'goal_home' . $i, $home );
      $i++;
    }

  }
}



function rf_goals_meta_box() {
  global $post;
  $values = get_post_custom( $post->ID );

  wp_nonce_field( 'meta-box-save', 'rfscore-plugin');
  ?>
  <table id="goalscorerTable">
    <thead>
      <tr>
        <th>Num</th>
        <th>Min</th>
        <th>Name</th>
        <th>Home goal</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 1;
      while( isset( $values['goal_min' . $i])) {
        echo 'goal home is ' . $values['goal_home' . $i][0];
        echo '<tr><td>' . $i . '</td>';
        echo '<td><input type="text" size="3" name="goal_min' . $i . '" value="' . $values['goal_min' . $i][0] . '"></input></td>';
        echo '<td><input type="text" size="10" name="goal_name' . $i . '" value="' . $values['goal_name' . $i][0] . '"></input></td>';

        if ($values['goal_home' . $i][0] == 1) {
          echo '<td><input type="checkbox" name="goal_home' . $i . '" checked="checked"></input></td>';
        } else {
          echo '<td><input type="checkbox" name="goal_home' . $i . '"></input></td>';
        }
        $i++;
      }
     ?>
    </tbody>
</table>
<button id="goal_add">Add goal</button>
<button id="goal_delete">Delete goal</button>
  <?php

}

 ?>
