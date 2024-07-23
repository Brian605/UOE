import './bootstrap';

const confirmDelete = (form, id) => {
  if (confirm('Are you sure you want to delete this record?') ===true) {
    document.getElementById(`${form}${id}`).submit();
  }
}
window.confirmDelete = confirmDelete;
