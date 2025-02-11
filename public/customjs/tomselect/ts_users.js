// Campos con clase tom-select usarán Tom-Select
document.querySelectorAll('.tom-select').forEach(function(select) {
    new TomSelect(select, {
        create: false,
        sortField: {
            field: "text",
            direction: "asc",
        },
        plugins: {
            'clear_button': {
                'title': 'Quitar selección',
            }
        },
    });
});