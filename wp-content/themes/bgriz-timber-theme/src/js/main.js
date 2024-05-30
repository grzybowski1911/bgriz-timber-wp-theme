document.addEventListener("DOMContentLoaded", function() {

    var menuItems = document.querySelectorAll('.main-menu > li');

    function setMenuChildrenWidth() {

        console.log('set menu width');

        var navContainer = document.querySelector('.nav-container');

        menuItems.forEach(function(menuItem) {
            var menuChildren = menuItem.querySelector('.menu-children');

            if (menuChildren && navContainer) {
                menuChildren.style.width = navContainer.offsetWidth + 'px';
            }
        });
    }

    setMenuChildrenWidth();

    window.addEventListener('resize', setMenuChildrenWidth);

    var menuItems = document.querySelectorAll('.main-menu > li');

    menuItems.forEach(function(menuItem) {
        var menuChildren = menuItem.querySelector('.menu-children');

        menuItem.addEventListener('mouseover', function() {
            if (menuChildren) {
                menuChildren.style.display = 'block';
            }
        });

        menuItem.addEventListener('mouseout', function(event) {
            if (!isCursorWithinElement(event, menuItem) && (!menuChildren || !isCursorWithinElement(event, menuChildren))) {
                if (menuChildren) {
                    menuChildren.style.display = 'none';
                }
            }
        });

        if (menuChildren) {
            menuChildren.addEventListener('mouseover', function() {
                menuChildren.style.display = 'block';
            });

            menuChildren.addEventListener('mouseout', function(event) {
                if (!isCursorWithinElement(event, menuItem) && !isCursorWithinElement(event, menuChildren)) {
                    menuChildren.style.display = 'none';
                }
            });
        }
    });

    function isCursorWithinElement(event, element) {
        if (!element) {
            return false;
        }
        
        var rect = element.getBoundingClientRect();
        return (
            event.clientX >= rect.left &&
            event.clientX <= rect.right &&
            event.clientY >= rect.top &&
            event.clientY <= rect.bottom
        );
    }

    let lastScrollTop = 0;
    const header = document.querySelector('.header');
    const sticky = 'sticky';
    const nosticky = 'not-sticky';
    const contactButton = document.getElementById('contactButton');

    window.addEventListener('scroll', () => {
      let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      if (scrollTop > lastScrollTop) {
        // Downscroll
        header.classList.remove(sticky);
        header.classList.add(nosticky);
        contactButton.style.transform = 'translateX(0%)';
      } else {
        // Upscroll
        header.classList.remove(nosticky);
        header.classList.add(sticky);
        contactButton.style.transform = 'translateX(150%)';
      }
      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
    });

    const contactOverlay = document.getElementById('contactOverlay');
    const closeButton = document.getElementById('closeButton');

    contactButton.addEventListener('click', () => {
      contactOverlay.classList.remove('hidden');
    });

    closeButton.addEventListener('click', () => {
      contactOverlay.classList.add('hidden');
    });

    contactOverlay.addEventListener('click', (e) => {
      if (e.target === contactOverlay) {
        contactOverlay.classList.add('hidden');
      }
    });

});
