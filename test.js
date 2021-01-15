$(document).ready(function(){
    trueBool = true;

    
    $("#boolbtn").click(function (e) { 
        e.preventDefault();
        console.log('clicked');
        console.log(trueBool);
        trueBool = false;
        console.log(trueBool);
    });

    $("#mybool").click(function(e) {

        if (trueBool) {
            console.log('true');
        } else {
            console.log('not true')
        }
    })
        
        

})
