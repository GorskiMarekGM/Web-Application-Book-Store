function deleteme(delid)
{
    if(confirm("Do you want Delete?")){
        window.location.href='delete.php?del_id='+ delid + '';
        return true;
    }
}
function add_to_cart(add,available)
{
    if(available==0){
        alert("Sorry, There is no more Available copies of this book")
        return true;
    }else
    {
        if(confirm("Do you want to add?")){
            window.location.href='ava.php?ava='+ available + '';
            window.location.href='add.php?add='+ add + '';
            return true;
        }
    }
    
}