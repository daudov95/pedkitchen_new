
const deleteBtn = document.querySelectorAll('.delete-btn');
const routeDelete = document.querySelector('.delete-route');

if(deleteBtn) {

  deleteBtn.forEach(el => el.addEventListener('click', (e) => {
    e.preventDefault();
    const id = Number(el.previousElementSibling.value);
    const action = confirm('Вы точно хотите удалить ?');

    if(action) {
      customFetch(routeDelete.action, id);
    }
  }));
}

function customFetch(route, id) {

  fetch(route,{
      method: 'POST',
      body: JSON.stringify({id: id}),
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
  }
  ).then(resp => {return resp.json()}).then(res => {
    console.log(res);
    if(res.status == true) {
      window.location.reload();
    }
  });


};