 angular.module('shopping').directive(
        'imageLazySrc', function($document, $window) {
          return {
            restrict: 'A',
            link: function($scope, $element, $attributes) {

              function isInView() {
                // get current viewport position and dimensions, and image position
                var clientHeight = $document[0].documentElement.clientHeight,
                    clientWidth = $document[0].documentElement.clientWidth,
                    imageRect = $element[0].getBoundingClientRect();

                if (
                    (imageRect.top >= 0 && imageRect.bottom <= clientHeight)
                    &&
                    (imageRect.left >= 0 && imageRect.right <= clientWidth)
                ) {
                  $element[0].src = $attributes.imageLazySrc; // set src attribute on element (it will load image)

                  // unbind event listeners when image src has been set
                  removeEventListeners();
                }
              }

              function removeEventListeners() {
                $window.removeEventListener('scroll', isInView);
                $window.removeEventListener('resize', isInView);
              }

              // bind scroll and resize event listener to window
              $window.addEventListener('scroll', isInView);
              $window.addEventListener('resize', isInView);

              // unbind event listeners if element was destroyed
              // it happens when you change view, etc
              $element.on('$destroy', function() {
                removeEventListeners();
              });

              // explicitly call scroll listener (because, some images are in viewport already and we haven't scrolled yet)
              isInView();
            }
          };
        }
    );
	
	
shopping.directive('asideDirective', function() {
	return {
		templateUrl:'app/webroot/js/angular/page/asidemenu.html',
	}
    
});
shopping.directive('userMenuDirective', function() {
	return {
		templateUrl:'app/webroot/js/angular/page/userMenu.html',
	}
    
});
shopping.directive('asidemenuDirective', function() {
	return {
		replace:true,
		templateUrl:'app/webroot/js/angular/page/aside.html'
	}
    
});
shopping.directive('vendorDirective', function() {
 return {
  replace:true,
  templateUrl:'app/webroot/js/angular/page/vendor.html'
 }
    
});
shopping.directive('errSrc', function() {
	console.log('errSrc');
      return {
        link: function(scope, element, attrs) {
          element.bind('error', function() {
            if (attrs.src != attrs.errSrc) {
              attrs.$set('src', attrs.errSrc);
            }
          });
          
          attrs.$observe('ngSrc', function(value) {
            if (!value && attrs.errSrc) {
              attrs.$set('src', attrs.errSrc);
            }
          });
        }
      }
    });