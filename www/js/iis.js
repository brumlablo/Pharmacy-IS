/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($){
     $(document).on("click","a[rel='modal_open']",function(event){
         event.preventDefault();
         $.nette.ajax(this.href).done(function(){
            $("#modal_window").modal({
                 backdrop: 'static',
                 keyboard: false
             }); 
         });
     });
     $(document).on("click","a[rel='modal_cancel']",function(event){
         event.preventDefault();
         $("#modal_window").modal("hide"); 
     });
/*
     $(document).on("submit","form.ajax", function () {
         $(this).ajaxSubmit();
         return false;
     });
     $(document).on("click","form.ajax :submit", function () {
         $(this).ajaxSubmit();
         return false;
     });*/
     
     $(document).ready(function(){
         $.nette.init();
     });

 })(jQuery);