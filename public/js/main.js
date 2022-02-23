function get_data(text) {
  if (text.length == 0) {
    document.querySelector(".output").innerHTML = "";
  } else {
    let form = new FormData();
    form.append("text", text);

    ajax = new XMLHttpRequest();
    ajax.addEventListener("readystatechange", function (e) {
      if (ajax.readyState == 4 && ajax.status == 200) {
        handle_result(ajax.responseText);
      }
    });

    ajax.open("POST", "http://localhost/blogcms/search", true);
    ajax.send(form);
  }
}

function handle_result(res) {
  let response = JSON.parse(res);

  let resDiv = document.querySelector(".output");
  let str = "";
  response.forEach((el) => {
    str += `
    
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>${el.first_name}</td>
                    <td>${el.last_name}</td>
                    <td><a href="http://localhost/blogcms/users/profile/${el.user_id}">View Profile</a></td>
                </tr>
            </tbody>
        </table>
  
    `;
  });
  resDiv.innerHTML = str;
}
