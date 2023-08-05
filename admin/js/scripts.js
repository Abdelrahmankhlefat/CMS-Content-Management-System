tinymce.init({
  selector: 'textarea',
  plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
  toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
  toolbar_mode: 'floating',
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
});


$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
      if(this.checked == true)
      {
        $('.checkBoxes').each(function(){
          this.checked = true; 
        })
      }else{
        $('.checkBoxes'). each(function(){
          this.checked = false;
        })
      } 
    })
});












function loadUsers(){
  $.get("functions.php?onlineusers=result", function(data){
    $(".usersonline"). text(data);
  }); 

}