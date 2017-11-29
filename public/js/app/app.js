/**
 * Created by usman arshad on 6/15/2017.
 */

var app = angular.module('codesnooker', ["ngRoute", "angular-loading-bar", "toastr", "ngAnimate","ui.tinymce","ui.select","ngSanitize","thatisuday.dropzone"]);
app.config(function(dropzoneOpsProvider){
    dropzoneOpsProvider.setOptions({
        url : '/upload.php',
        acceptedFiles : 'image/jpeg, images/jpg, image/png',
        addRemoveLinks : true,
        dictDefaultMessage : 'Click to add or drop photos',
        dictRemoveFile : 'Remove photo',
        dictResponseError : 'Could not upload this photo'
    });
});

//Service for getting all  Categories
app.service('getCategories', function ($http) {
    this.categories = function () {
        return $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/v1/allcategories'
        }).then(function (data) {
            return data;
        });
    }
});

// Service for getting  id from the url
app.service('IdService', function () {
    this.getid = function ($location) {
        var url = $location.absUrl().split('/');
        var id = url[5];
        return id;
    }
});

// Get Slug Url for SEO

app.factory('SeoService', function() {
    return {
        slug: function(title) {
            if (!title)
                return;
            // make lower case and trim
            var slug = title.toLowerCase().trim();

            // replace invalid chars with spaces
            slug = slug.replace(/[^a-z0-9\s-]/g, ' ');

            // replace multiple spaces or hyphens with a single hyphen
            slug = slug.replace(/[\s-]+/g, '-');

            return slug;
        }
    };
});

/* home Controller */
app.controller("homeController", function ($scope, $http, $location) {

});

/* Category Controller */
app.controller("categoryController", function ($scope, $http, $location,IdService,getCategories,toastr) {

    // All Category

    var categoryTable;
    $scope.categories = [];
    var cat = getCategories.categories();
    cat.then(function (data) {
        $scope.categories = data.data;
        console.log(data.data);
        setTimeout(function () {
            categoryTable = $('#allcategories').dataTable();
        }, 50);
    });

    // Add Category
    $scope.addCategory = function () {

        var data ={'name': $scope.category,'description':$scope.description};
        console.log(data);
        $http({
            method: 'POST',
            url: 'http://127.0.0.1:8000/api/v1/category',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')
            },
            data: $.param(data)
        }).then(function successCallback(response) {
            toastr.success('Success!', 'The Category has been added!');
            $location.path('/allcategories');
        }, function errorCallback(response) {
            toastr.error('Enter the unique Category', 'Error!');
        });
    };

    /* delete a category */
    $scope.delete = function (category) {
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/v1/category/delete/' + category.id
        }).then(function successCallback(response) {

            toastr.success('The category has been Deleted', 'Success');
            categoryTable.fnDestroy();
            $scope.categories = [];
            var cat = getCategories.categories();
            cat.then(function (data) {
                $scope.categories = data.data;
                setTimeout(function () {
                    var table = $('#allcategories').dataTable();
                }, 50);
            });

        }, function errorCallback(response) {
            toastr.error('There is some problem in deleting', 'Error!');
        });
    }


});


app.controller("editCategoryController", function ($scope, $http, $location, toastr, IdService) {

    var id = IdService.getid($location);

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/v1/category/edit/' + id
    }).then(function successCallback(response) {
        $scope.category = response.data.name;
        $scope.description=response.data.description;
    });


    $scope.updateCategory = function () {
        var data = {'name': $scope.category,'description':$scope.description};
        $http({
            method: 'POST',
            url: 'http://127.0.0.1:8000/api/v1/category/update/' + id,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')
            },
            data: $.param(data)
        }).then(function successCallback(response) {
            toastr.success('Success!', 'The Category has been updated!');
            $location.path('/allcategories');
        }, function errorCallback(response) {
            toastr.error('Enter the unique Category', 'Error!');
        });
    }

});

/* Post Controller */
app.controller("postController", function ($scope, $http, $location,IdService,getCategories,toastr,SeoService) {

    $scope.tinymceOptions = {
        plugins: 'link image code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code | image',
        height : "300",
        menubar:false
    };

    $scope.dzOptions = {
        paramName : 'photo',
        maxFilesize : '10'
    };

    $scope.dzCallbacks = {
        'addedfile' : function(file){
            console.info('File added from dropzone 1.', file);
        }
    };


    $scope.categories=[];
    var cat = getCategories.categories();
    cat.then(function (data) {
        $scope.categories = data.data;
        $scope.selected = { value: $scope.categories[0] };
    });

    /* get all posts */
    var postTable;
    $scope.posts = [];
    $http({
        method :'GET',
        url:'http://127.0.0.1:8000/api/v1/allposts'
    }).then(function successCallback(response){
       $scope.posts=response.data;
        setTimeout(function () {
            postTable = $('#allposts').dataTable({
                "bSort": false
            });
        }, 50);
    },function errorCallback(response) {

    });



    $scope.addPost = function () {
        var title=$scope.title;
        var slugUrl=SeoService.slug(title);
        var catid=$scope.selected.value.id;
        var data = {'title':title,'slug_url':slugUrl,'description':$scope.tinymceModel,'catid':catid};
        console.log(data);
        $http({
            method: 'POST',
            url: 'http://127.0.0.1:8000/api/v1/post',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')
            },
            data: $.param(data)
        }).then(function successCallback(response) {
            toastr.success('Success!', 'The Post has been added!');
            $location.path('/allposts');
        }, function errorCallback(response) {
            toastr["error"](response.data.error, "Error!");
        });

    };
    $scope.deletePost=function (post)
    {
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/v1/post/delete/' + post.id
        }).then(function successCallback(response) {
            toastr.success('The Post has been Deleted', 'Success');
            $scope.posts = [];
            $http({
                method :'GET',
                url:'http://127.0.0.1:8000/api/v1/allposts'
            }).then(function successCallback(response) {
                $scope.posts = response.data;
            });
            postTable.fnDestroy();
                setTimeout(function () {
                    var table = $('#allposts').dataTable(
                        {
                           "bsort":false
                        });
                }, 50);

        }, function errorCallback(response) {
            toastr.error('There is some problem in deleting', 'Error!');
        });
    }


});


app.config(function ($routeProvider) {
    $routeProvider.when('/', {
        templateUrl: 'templates/dashboard.html',
        Controller: 'homeController'
    }).when('/category', {
        templateUrl: 'templates/category/category.html',
        Controller:  'categoryController'
    }).when('/allcategories', {
        templateUrl: 'templates/category/angularcategories.html',
        Controller:  'categoryController'
    }).when('/editcategory/:id', {
        templateUrl: 'templates/category/editCategory.html',
        Controller : 'editCategoryController'
    }).when('/post', {
        templateUrl: 'templates/post/createpost.html',
        Controller : 'postController'
    }).when('/allposts',{
        templateUrl : 'templates/post/allposts.html',
        Controller  :  'postController'
    })

});







