document.addEventListener("DOMContentLoaded", function() {
    var menuItems = document.querySelectorAll('.main-menu > li');

    menuItems.forEach(function(menuItem) {
        var menuChildren = menuItem.querySelector('.menu-children');

        menuItem.addEventListener('mouseover', function() {
            if (menuChildren) {
                menuChildren.style.display = 'block';
            }
        });

        // Add mouseout event listener to hide the menu-children only when the cursor leaves both the parent and children
        menuItem.addEventListener('mouseout', function(event) {
            if (!isCursorWithinElement(event, menuItem) && !isCursorWithinElement(event, menuChildren)) {
                menuChildren.style.display = 'none';
            }
        });

        // Add mouseover event listener to keep the menu-children open while the cursor is within them
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

    // Helper function to check if the cursor is within an element
    function isCursorWithinElement(event, element) {
        var rect = element.getBoundingClientRect();
        return (
            event.clientX >= rect.left &&
            event.clientX <= rect.right &&
            event.clientY >= rect.top &&
            event.clientY <= rect.bottom
        );
    }
});
