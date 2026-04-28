// select all
function initBulkSelect() {
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const counter = document.getElementById('selected-count');

    if (!selectAll) return;

    selectAll.addEventListener('change', function () {
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateCounter();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateCounter);
    });

    function updateCounter() {
        if (!counter) return;
        counter.textContent =
            document.querySelectorAll('.item-checkbox:checked').length + ' selected';
    }
}

// delete confirm
function confirmSingleDelete(url) {
    if (confirm('Are you sure?')) {
        let form = document.getElementById('single-delete-form');
        form.action = url;
        form.submit();
    }
}

// run when page loads
document.addEventListener('DOMContentLoaded', function () {
    initBulkSelect();
});
