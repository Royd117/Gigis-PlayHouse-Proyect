var loadFile = function(event)
{
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
};

function searchBar() {
  // Declare variables
  var input, filter, ul, div, label, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  div = ul.getElementsByTagName('div');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < div.length; i++) {
    label = div[i].getElementsByTagName("label")[0];
    txtValue = label.textContent || label.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      div[i].style.display = "";
    } else {
      div[i].style.display = "none";
    }
  }
}