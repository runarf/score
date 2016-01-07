<?php
  $teams = get_post_meta( get_the_ID() );
  $
  $team_home = isset( $teams['team_home']) ? $teams['team_home'][0] : '';
  $team_away = isset( $teams['team_away']) ? $teams['team_away'][0] : '';

  echo '<table> <thead> <tr>';
  echo '<th>' . $team_home . '</th>';
  echo '<th>' . $team_away . '</th></tr>';
  echo '</thead> </table>';

 ?>
