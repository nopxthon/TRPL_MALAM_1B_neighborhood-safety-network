

function showOrganisasiItems(){  
    $.ajax({
        url:"./adminView/viewAllOrganisasi.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showCategory(){  
    $.ajax({
        url:"./adminView/viewCategories.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showSizes(){  
    $.ajax({
        url:"./adminView/viewSizes.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showOrganisasiSizes(){  
    $.ajax({
        url:"./adminView/viewOrganisasiSizes.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function showCustomers(){
    $.ajax({
        url:"./adminView/viewCustomers.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function showValidasi(){
    $.ajax({
        url:"./adminView/viewAllValidasi.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function ChangevalidasiStatus(id){
    $.ajax({
       url:"./controller/updatevalidasiStatus.php",
       method:"post",
       data:{record:id},
       success:function(data){
           alert('Order Status updated successfully');
           $('form').trigger('reset');
           showValidasi();
       }
   });
}

function ChangePay(id){
    $.ajax({
       url:"./controller/updatePayStatus.php",
       method:"post",
       data:{record:id},
       success:function(data){
           alert('Payment Status updated successfully');
           $('form').trigger('reset');
           showValidasi();
       }
   });
}


//add organisasi data
function addItems(){
    var p_name=$('#p_name').val();
    var p_desc=$('#p_desc').val();
    var p_price=$('#p_price').val();
    var category=$('#category').val();
    var upload=$('#upload').val();
    var file=$('#file')[0].files[0];

    var fd = new FormData();
    fd.append('p_name', p_name);
    fd.append('p_desc', p_desc);
    fd.append('p_price', p_price);
    fd.append('category', category);
    fd.append('file', file);
    fd.append('upload', upload);
    $.ajax({
        url:"./controller/addItemController.php",
        method:"post",
        data:fd,
        processData: false,
        contentType: false,
        success: function(data){
            alert('Organisasi Added successfully.');
            $('form').trigger('reset');
            showOrganisasiItems();
        }
    });
}

//edit organisasi data
function itemEditForm(id){
    $.ajax({
        url:"./adminView/editItemForm.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

//update organisasi after submit
function updateItems(){
    var id_organisasi = $('#id_organisasi').val();
    var nama = $('#nama_organisasi').val();
    var password = $('#password').val();
    var ketua = $('#ketua_organisasi').val();
    var sosmed = $('#social_media').val();
    var deskripsi = $('#deskripsi_organisasi').val();
    var email = $('#email').val();
    var username = $('#username').val();
    var status = $('#status').val();

    var fd = new FormData();
    fd.append('id_organisasi', id_organisasi);
    fd.append('nama_organisasi', nama);
    fd.append('password', password);
    fd.append('ketua_organisasi', ketua);
    fd.append('social_media', sosmed);
    fd.append('deskripsi_organisasi', deskripsi);
    fd.append('email', email);
    fd.append('username', username);
    fd.append('status', status);

    $.ajax({
      url:'./controller/updateItemController.php',
      method:'post',
      data:fd,
      processData: false,
      contentType: false,
      success: function(data){
        alert('Data Update Success.');
        $('form').trigger('reset');
        showOrganisasiItems();
      }
    });
}

//delete organisasi data
function itemDelete(id){
    $.ajax({
        url:"./controller/deleteItemController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Items Successfully deleted');
            $('form').trigger('reset');
            showOrganisasiItems();
        }
    });
}


//delete cart data
function cartDelete(id){
    $.ajax({
        url:"./controller/deleteCartController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Cart Item Successfully deleted');
            $('form').trigger('reset');
            showMyCart();
        }
    });
}

function eachDetailsForm(id){
    $.ajax({
        url:"./view/viewEachDetails.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}



//delete category data
function categoryDelete(id){
    $.ajax({
        url:"./controller/catDeleteController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Category Successfully deleted');
            $('form').trigger('reset');
            showCategory();
        }
    });
}

//delete size data
function sizeDelete(id){
    $.ajax({
        url:"./controller/deleteSizeController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Size Successfully deleted');
            $('form').trigger('reset');
            showSizes();
        }
    });
}


//delete variation data
function variationDelete(id){
    $.ajax({
        url:"./controller/deleteVariationController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Successfully deleted');
            $('form').trigger('reset');
            showOrganisasiSizes();
        }
    });
}

//edit variation data
function variationEditForm(id){
    $.ajax({
        url:"./adminView/editVariationForm.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}


//update variation after submit
function updateVariations(){
    var v_id = $('#v_id').val();
    var product = $('#product').val();
    var size = $('#size').val();
    var qty = $('#qty').val();
    var fd = new FormData();
    fd.append('v_id', v_id);
    fd.append('product', product);
    fd.append('size', size);
    fd.append('qty', qty);
   
    $.ajax({
      url:'./controller/updateVariationController.php',
      method:'post',
      data:fd,
      processData: false,
      contentType: false,
      success: function(data){
        alert('Update Success.');
        $('form').trigger('reset');
        showOrganisasiSizes();
      }
    });
}
function search(id){
    $.ajax({
        url:"./controller/searchController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('.eachCategoryOrganisasi').html(data);
        }
    });
}


function quantityPlus(id){ 
    $.ajax({
        url:"./controller/addQuantityController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('form').trigger('reset');
            showMyCart();
        }
    });
}
function quantityMinus(id){
    $.ajax({
        url:"./controller/subQuantityController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('form').trigger('reset');
            showMyCart();
        }
    });
}

function checkout(){
    $.ajax({
        url:"./view/viewCheckout.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}


function removeFromWish(id){
    $.ajax({
        url:"./controller/removeFromWishlist.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Removed from wishlist');
        }
    });
}


function addToWish(id){
    $.ajax({
        url:"./controller/addToWishlist.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Added to wishlist');        
        }
    });
}