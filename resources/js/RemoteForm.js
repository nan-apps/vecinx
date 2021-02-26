
window.RemoteForm = class RemoteForm {


  constructor(form){
    this.form = form;
    this.successCallback = null;
  }

  init(){

    this.form.off("submit").on("submit", ()=>{

      axios.post(this.form.attr('action'), this.form.serialize()).then( (response) => {

        if(response.data.success){

          if(this.successCallback)
            this.successCallback();

        } else {
          alert("Error enviando datos");
        }

      }).catch((err)=>{
        if(err.response.status == 422){
          this.manageValidationErrors(err.response.data.errors);
        } else {
          alert("Error enviando datos");
          console.log(err);
        }
      });
      return false;
    });

  }

  manageValidationErrors(errors){
    let html = "<ul>";
    for( error in errors ){ 
      html += "<li>"+ errors[error] +"</li>"
    }
    html += "</ul>";

    this.form.find(".alert-validation").html(html);
    this.form.find(".alert-validation").removeClass("d-none");


  }


}
