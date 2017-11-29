/**
 * Created by usman arshad on 11/10/2017.
 */
app.controller("categoryController", function ($scope, $http , $compile ) {

    getCategories();
    function getCategories() {
        $('#category-table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                type:'POST',
                url: '/api/blog/categories',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                {title:'#',data: 'rownum', name: 'rownum', searchable: false},
                {title: 'Category Name', data: 'name'},
                {title: 'Slug', data:'slug_category'},
                {title: 'Action',data: 'action', searchable: false}
            ],
            "createdRow": function ( row, data, index ) {
                $compile(row)($scope);  //add this to compile the DOM
            }
        });
    }

    $scope.showCategoryModal = function () {
        $scope.form_title = 'Add Category';
        $scope.btn_value = 'Submit';
        $scope.name = '';
        $scope.type = 'addCategory';
        $('#categoryName').val('');
        $('#categoryModal').modal('show');
    };
    $scope.addCategory = function () {
// post category
        $http({
            method: 'POST',
            url: '/api/blog/createCategory',
            data: $('#categoryForm').serialize(),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            $('#categoryModal').modal('hide');
            getCategories();
        }).catch(function(response) {
        }).finally(function() {

        });
    };

 // Edit Category
    $scope.editCategory = function ( id )  {
        $http({
            method: 'GET',
            url :'/api/blog/getCategory',
            params : {
                id : id
            }
        }).then ( function ( response ){
            $scope.id = response.data.id;
            $scope.form_title = 'Edit Category';
            $scope.btn_value = 'Update';
            $scope.name = response.data.name;
            $scope.type = 'editCategory';
            $('#categoryModal').modal('show');
        }).catch( function ( data )  {
        }).finally ( function () {

        });
    };
    // Delete Category
    $scope.deleteCategory = function ( id ) {
        $.confirm({
            title: 'Confirm!',
            content: 'Do you want to delete this category?',
            buttons: {
                Confirm:{
                    btnClass: 'btn-red',
                    action: function(){
                        $http({
                            method: 'DELETE',
                            url :'/api/blog/deleteCategory',
                            params : {
                                id : id
                            }
                    }).then ( function ( response ) {
                        getCategories();
                    }).catch ( function ( data )  {
                    }).finally ( function (  ) {
                    });
                    }
                },
                cancel: function () {

                }
            }
        });
        
    };
});
app.controller('createPostController', function($scope, $http, $location) {
    // initialize blog
    $scope.editor_config = {
        path_absolute : "/",
        selector: "textarea",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern autoresize"
        ],
        row: true,
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = $scope.editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type === 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        },

        init_instance_callback: function(editor) {
            var textContentTrigger = function() {
                $scope.textContent = editor.getBody().textContent;
                $scope.$apply();
            };

            editor.on('KeyUp', textContentTrigger);
            editor.on('ExecCommand', textContentTrigger);
            editor.on('SetContent', function(e) {
                if(!e.initial)
                    textContentTrigger();
            });
        }
    };
    // get Blog Category
    $scope.categories = [];
    $http({
        method: 'GET',
        url :'/api/blog/getBlogCategories'
    }).then ( function ( response ){
        $scope.categories = response.data;
    }).catch( function ( data )  {
    }).finally ( function () {

    });


    $scope.submitBlog = function () {
        var tags = [];
        for( var index = 0; index < $scope.tags.length; index ++  ) {
            tags.push( $scope.tags[index].text );
        }
        $('#tags').val( tags.join(',') );
        $http({
            method: 'POST',
            url :'/api/blog/createPost',
            data : $('#createBlog').serialize(),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then ( function ( response ){
            $location.path("/post");
        }).catch( function ( data )  {
        }).finally ( function () {

        });

    };
});
app.controller('PostController', function ($scope, $http, $location) {
    $scope.posts = [];
    getPost();
    function getPost() {
        $http({
            method: 'GET',
            url:'/api/blog/posts'
        }).then ( function ( response ){
            $scope.posts = response.data;

        }).catch( function ( data )  {
        }).finally ( function () {
        });
    }
    // delete a post
    $scope.deletePost = function ( id ) {
        $.confirm({
            title: 'Confirm!',
            content: 'Do you want to delete this Post?',
            buttons: {
                Confirm:{
                    btnClass: 'btn-red',
                    action: function(){
                        $http({
                            method: 'DELETE',
                            url :'/api/blog/deletePost',
                            params : {
                                id : id
                            }
                        }).then ( function ( response ) {
                            getPost();
                        }).catch ( function ( data )  {
                        }).finally ( function (  ) {
                        });
                    }
                },
                cancel: function () {

                }
            }
        });
    };
});
app.controller('updatePostController', function ( $scope, $http ) {
    $scope.categories = [];
    $http({
        method: 'GET',
        url :'/api/blog/getBlogCategories'
    }).then ( function ( response ){
        $scope.categories = response.data;
    }).catch( function ( data )  {
    }).finally ( function () {

    });
});

app.config(function($routeProvider) {
    $routeProvider
        .when("/category", {
            templateUrl : "templates/category/category.html",
            controller : "categoryController"
        })
        .when("/post", {
            templateUrl : "templates/post/allpost.html",
            controller: "PostController"
        })
        .when("/create/post", {
           templateUrl : "templates/post/createPost.html",
           controller : "createPostController"
        })
        .when("edit/post/:id", {
          templateUrl : "templates/post/editPost.html",
          controller: "updatePostController"
        })


});
