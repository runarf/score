<?php
  $teams = get_post_meta( get_the_ID() );
  $goals = get_post_meta( get_the_ID(), '_goals', true);
  $team_home = isset( $teams['team_home']) ? $teams['team_home'][0] : '';
  $team_away = isset( $teams['team_away']) ? $teams['team_away'][0] : '';

  echo '<table> <thead> <tr>';
  echo '<th colspan="3">' . $team_home . '</th>';
  echo '<th colspan="3">' . $team_away . '</th></tr>';
  echo '</thead>';
  
  $i = 1;
  while (isset($goals[$i])) {
    $min = (! empty ( $goals[$i]['min'])) ? $goals[$i]['min'] : '??';
    $name = $goals[$i]['name'];
    $home = isset( $goals[$i]['home']) ? True : False;
    $table_data_goal = '<td>' . $min . '</td><td>' .$name . '</td><td> &#x26BD; </td>';
    $table_data_empty = '<td></td><td></td><td></td>';
    echo '<tr>';
    if ($home){
      echo $table_data_goal . $table_data_empty;
    } else {
      echo $table_data_empty . $table_data_goal;
    }
    echo '</tr>';
    $i++;
  }
  echo '</table>';

 ?>
