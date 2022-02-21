var category = document.getElementById("category__selector");

$("#category__selector").change(function (e) {
  let categoryValue = e.target.value;
  console.log(e.target.value);
  $.ajax({
    url: "category/" + categoryValue,
    type: "GET",
    success: function (result) {

      const newResult = result.map(data => {
        return createHtml(data);
      });
      appendToHtml(newResult);
    },
  });
});

function createHtml(data) {
  htmlString = `				
  <div class="my-2">
  <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="${data.image}" alt="Card image cap"/>

    <div class="card-body">
      <h5 class="card-title">
      ${data.title}
      </h5>
      <p class="card-text">
      ${data.body.replace(/<\/?[^>]+(>|$)/g, "").substr(0, 160) + "..."}
      </p>
      <a href="article/${data.id}" class="btn btn-primary home-read-more">
        Read More
      </a>
    </div>
  </div>
</div>`;

  return htmlString;
}

var div = document.getElementById('category__section3');

function appendToHtml(htmlString){
  div.innerHTML ="";
  htmlString.forEach(element => {
    div.innerHTML += element;

  });
}
