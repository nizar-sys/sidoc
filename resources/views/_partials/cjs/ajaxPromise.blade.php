<script>
    function HitData(url, data = null, type, ...args) {
        return new Promise((resolve, reject) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });
            $.ajax({
                url: url,
                data: data,
                type: type,
                success: function (response) {
                    resolve(response);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }
</script>