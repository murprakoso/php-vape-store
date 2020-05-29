$(document).ready(function () {
   $('#sidebarCollapse').on('click', function () {
       $('#sidebar').toggleClass('active');
   });
});

function readURLA(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
          $('#fotoproduk')
             .attr('src', e.target.result);
          };

          reader.readAsDataURL(input.files[0]);
      }
}

function readURLB(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
          $('#avatarlama')
             .attr('src', e.target.result);
          };

          reader.readAsDataURL(input.files[0]);
      }
}

