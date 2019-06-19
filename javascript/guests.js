function isCheck(a,b) {

    let page = '';
    if (page == undefined) {
      page = 1;
    }else{
      page = b;
    }
    // alert(b);
    let id = a;
    let num = 0;

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
    {
      if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
      {
        let output = "";
        let div = document.getElementById('ul');
        data = JSON.parse(xmlHttp.response);

        if (data.length == 0) {
          output += "<h1 class='alert alert-danger'>No more guests in thiss page.</h1>";
          div.innerHTML = output;
        }else{
          data.forEach((guest)=>{
            output += "<ul class='list-group' id='ul'>";
            output += '<div class="row">';
            if (num == 0) {
              output += `<li class="list-group-item col-4 font-weight-bold">Name</li>
              <li class="list-group-item col-4 font-weight-bold">Surname</li>
              <li class="list-group-item col-4 font-weight-bold  text-center">Check-in</li>`;
              num =1;
            }
            output += `<li class="list-group-item col-4">${guest.name}</li>`;
            output += `<li class="list-group-item col-4">${guest.surname}</li>`;
            output += `<li class="list-group-item col-4 text-center">`;
            output += `<input type="checkbox"  id='checkbox' onclick="isCheck(${guest.id},${page})">`;
            output += '</li>';
            output += '</div>';
            output += '</ul>';

            div.innerHTML = output;
          });
        }
      }
    }
    xmlHttp.open("post", "../backend/checked.php");
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlHttp.send('id='+id+'& page=' + page);
}

function isCheckUser(a,b,s) {
  let page = b;
  let id = a;
  let num = 0;
  let search = s;
  alert(search);

  let xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
    {
      let output = "";
      let div = document.getElementById('ul');
      data = JSON.parse(xmlHttp.response);

      if (data.length == 0) {
        output += "<h1 class='alert alert-danger'>No more guests with this name/surname.</h1>";
        div.innerHTML = output;
      }else{
        data.forEach((guest)=>{
          output += "<ul class='list-group' id='ul'>";
          output += '<div class="row">';
          if (num == 0) {
            output += `<li class="list-group-item col-4 font-weight-bold">Name</li>
            <li class="list-group-item col-4 font-weight-bold">Surname</li>
            <li class="list-group-item col-4 font-weight-bold  text-center">Check-in</li>`;
            num =1;
          }
          output += `<li class="list-group-item col-4">${guest.name}</li>`;
          output += `<li class="list-group-item col-4">${guest.surname}</li>`;
          output += `<li class="list-group-item col-4 text-center">`;
          output += `<input type="checkbox"  id='checkbox' onclick="isCheckUser(${guest.id},${window.location.search.substr(1)},${search})">`;
          output += '</li>';
          output += '</div>';
          output += '</ul>';


          div.innerHTML = output;
        });
      }
    }
  }
  xmlHttp.open("post", "../backend/searchcheck.php");
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send('id='+id+'& page=' + page+'& search=' +search);
}
