$('#dept_form').on('submit', function(e) {
  $.ajax({
    url: 'submit_dept.php',
    data: $(this).serialize(),
    type: 'POST',
    success: function(data) {
      console.log(data);
      if(data != "Error") {
        $('#success').html(data).show().fadeOut(5000);
        $('#dept_name').val('');
      } else {
        $('#error').html(data).show().fadeOut(5000);
      }
    },
    error:  function(data) {
      $('#error').show().fadeOut(5000);
    }
  });
  e.preventDefault();
});

$('#spec_form').on('submit', function(e) {
  $.ajax({
    url: 'submit_spec.php',
    data: $(this).serialize(),
    type: 'POST',
    success: function(data) {
      console.log(data);
      if(data != "Error") {
        $('#success').html(data).show().fadeOut(5000);
        $('#spec_n').val('');
      } else {
        $('#error').html(data).show().fadeOut(5000);
      }
    },
    error: function(data) {
      $('#error').show().fadeOut(5000);
    }
  });
  e.preventDefault();
});

$('#conc_form').on('submit', function(e) {
  $.ajax({
    url: 'submit_conc.php',
    data: $(this).serialize(),
    type: 'POST',
    success: function(data) {
      console.log(data);
      if(data != "Error") {
        $('#success').html(data).show().fadeOut(5000);
        $('#concern').val('');
      } else {
        $('#error').html(data).show().fadeOut(5000);
      }
    },
    error: function(data) {
      $('#error').show().fadeOut(5000);
    }
  });
  e.preventDefault();
});