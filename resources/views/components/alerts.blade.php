<script>
    window.livewire.on('bake-alert', data => {
        Swal.fire({
            icon: data.type,
            title: data.title,
            html: data.message
        })
    });
</script>
