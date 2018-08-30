/* 
 Shop Cart product controllers
 */


ClassApartStore.controller('ShopController', function ($scope, $http, $timeout, $interval, $filter) {
    var globlecart = baseurl + "Api/cartOperation";
    $scope.product_quantity = 1;

    var currencyfilter = $filter('currency');

    $scope.globleCartData = {};//cart data

    //get cart data
    $scope.getCartData = function () {
        $http.get(globlecart).then(function (rdata) {
            $scope.globleCartData = rdata.data;
            $scope.globleCartData['grand_total'] = $scope.globleCartData['total_price'];
        }, function (r) {
        })
    }
    $scope.getCartData();

    //remove cart data
    $scope.removeCart = function (product_id) {
        $http.delete(globlecart + "/" + product_id).then(function (rdata) {
            console.log("asdfsadf");
            $scope.getCartData();
        }, function (r) {
        })
    }

    //update cart
    $scope.updateCart = function (product_id, quantity) {
        $http.put(globlecart + "/" + product_id + "/" + quantity).then(function (rdata) {
            $scope.getCartData();
        }, function (r) {
        })
    }

    //add cart product
    $scope.addToCart = function (product_id, quantity) {
        var productdict = {
            'product_id': product_id,
            'quantity': quantity,
        }
        var form = new FormData()
        form.append('product_id', product_id);
        form.append('quantity', quantity);
        swal({
            title: 'Adding to Cart',
            onOpen: function () {
                swal.showLoading()
            }
        })
        $http.post(globlecart, form).then(function (rdata) {
            swal.close();
            $scope.getCartData();
            swal({
                title: 'Added To Cart',
                type: 'success',
                html: "<p class='swalproductdetail'><span>" + rdata.data.title + "</span><br>" + "Total Price: " + currencyfilter(rdata.data.total_price, 'HK$  ') + ", Quantity: " + rdata.data.quantity + "</p>",
                imageUrl: rdata.data.file_name,
                imageWidth: 100,
                timer: 1500,
//                 background: '#fff url(//bit.ly/1Nqn9HU)',
                imageAlt: 'Custom image',
                showConfirmButton: false,
                animation: true

            }).then(
                    function () {
                    },
                    function (dismiss) {
                        if (dismiss === 'timer') {
                        }
                    }
            )
        }, function () {
            swal.close();
            swal({
                title: 'Something Wrong..',
            })
        });
    }

    $scope.avaiblecredits = avaiblecredits;
    console.log($scope.avaiblecredits);
    
    $scope.checkOrderTotal = function(){
        if($scope.globleCartData.used_credit){
            $scope.globleCartData.grand_total =$scope.globleCartData.total_price - $scope.globleCartData.used_credit;
        }
        else{
            $scope.globleCartData.used_credit = 0;
            $scope.globleCartData.grand_total =$scope.globleCartData.total_price;
            alert("Invalid Credit Entered.")
        }
    }
    

   

    //Get Menu data
    var globlemenu = baseurl + "Api/categoryMenu";
    $http.get(globlemenu).then(function (r) {
        $scope.categoriesMenu = r.data;
        console.log(r.data)
    }, function (e) {
    })
})

