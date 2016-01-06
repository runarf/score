jQuery(document).ready(function($) {
  var num = $("#goalscorerTable tr").length;

  $("#goal_add").click(function(event){
    event.preventDefault();
    console.log("Number is " + num);
    console.log("Appending table");
    $("#goalscorerTable").append(
      '<tr><td>' + num + '</td>' +
      '<td> <input type="text" size="3" name="goal' + num + '"></input></td>' +
      '<td> <input type="text" size="10" name="goal_name' + num + '"></input></td>' +
      '<td> <input type="checkbox" name="goal_home' + num + '"></input></td></tr>'
    );
    num++;
  });

  $("#goal_delete").click(function(event) {
    event.preventDefault();
    if ($("#goalscorerTable tr").length > 1) {
      $("#goalscorerTable tr").last().remove();
      num--;
    }
  })
});
