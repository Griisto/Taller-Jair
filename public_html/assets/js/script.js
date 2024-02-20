document.addEventListener('DOMContentLoaded', function () {
    const imageContainer = document.getElementById('imageContainer');
    const profilePicInput = document.getElementById('profilePic');
    const deleteButton = document.getElementById('deleteButton');
  
    profilePicInput.addEventListener('change', function () {
      const file = this.files[0];
  
      if (file) {
        const reader = new FileReader();
  
        reader.onload = function (e) {
          imageContainer.style.backgroundImage = `url(${e.target.result})`;
          deleteButton.style.display = 'block';
        };
  
        reader.readAsDataURL(file);
      }
    });
  
    deleteButton.addEventListener('click', function () {
      imageContainer.style.backgroundImage = 'none';
      profilePicInput.value = '';
      deleteButton.style.display = 'none';
    });
  });
  