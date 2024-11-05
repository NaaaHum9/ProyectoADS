function reCheckbox(val){
    document.getElementById('rating-5').checked = false;
    document.getElementById('rating-4').checked = false;
    document.getElementById('rating-3').checked = false;
    document.getElementById('rating-2').checked = false;
    document.getElementById('rating-1').checked = false;
    document.getElementById('rating-0').checked = false;
    if(val==5){
        document.getElementById('rating-5').checked = true;
    }else if(val==4){
        document.getElementById('rating-4').checked = true;
    }else if(val==3){
        document.getElementById('rating-3').checked = true;
    }else if(val==2){
        document.getElementById('rating-2').checked = true;
    }else if(val==1){
        document.getElementById('rating-1').checked = true;
    }else if(val==0){
        document.getElementById('rating-0').checked = true;
    }
     
    }