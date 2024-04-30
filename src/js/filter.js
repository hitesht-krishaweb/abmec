function fFilter() {
    const filters = {
        filterForm: document.querySelector('[data-module-filter]'),
        filterGroups: null,
        filterInputs: null,
        filterToggle: null,
        filterCol: null,
        init: () => {
            filters.filterGroups = filters.filterForm.querySelectorAll('.filter__group');
            filters.filterInputs = filters.filterForm.elements;
            filters.filterToggle = filters.filterForm.querySelector('[data-module-filter-toggle]');
            filters.filterCol = filters.filterForm.querySelector('[data-module-filter-filters]');

            filters.addEventHandlers();
        },
        addEventHandlers: () => {
            // Collapse filter group on title click
            filters.filterGroups.forEach((group) => {
                let title = group.querySelector('.filter__group__title');
                title.addEventListener('click', () => {
                    filters.toggleFilterGroup(group);
                })
            });

            // Submit form when filter changes
            Array.prototype.forEach.call(filters.filterInputs, (input) => {
                input.addEventListener('change', filters.submitForm);
            });

            if (filters.filterToggle && filters.filterCol) {
                filters.filterToggle.addEventListener('click', filters.toggleFilters);
            }
        },
        toggleFilterGroup: (group) => {
            let groupContent = group.querySelector('.filter__group__content');

            if (groupContent.getAttribute('data-collapsed')) {
                groupContent.removeAttribute('data-collapsed');
            } else {
                groupContent.setAttribute('data-collapsed', null);
            }
        },
        toggleFilters: () => {
           if (filters.filterCol.classList.contains('d-none')) {
                filters.filterCol.classList.remove('d-none')
           } else {
                filters.filterCol.classList.add('d-none')
           }
        },
        submitForm: () => {
            filters.filterForm.submit();
        }
    }

    if (filters.filterForm) {
        filters.init();
    }
}