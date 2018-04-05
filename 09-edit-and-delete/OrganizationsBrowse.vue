<template>
    <table id="organizations" class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">Country</th>
                <th scope="col">Type</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
    </table>
</template>

<script>
    import 'datatables.net-bs4';
    import 'datatables.net-bs4/css/dataTables.bootstrap4.css';
    export default {
        props: ['organizations'],
        mounted() {
            window.table = $('#organizations').DataTable({
                data: this.organizations,
                columns: [
                    { data: 'name' },
                    { data: 'city' },
                    { data: 'state' },
                    { data: 'country' },
                    {
                        data: 'type_id',
                        render: (data) => {
                            switch (data) {
                                case 1:
                                    return 'Lead';
                                    break;
                                case 2:
                                    return 'Prospect';
                                    break;
                                case 3:
                                    return 'Client';
                                    break;
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: data => {
                            return `<a href="/organizations/${data}/edit" class="edit btn btn-primary btn-sm" role="button" aria-pressed="true">Edit</a>`;
                        }
                    },
                    {
                        data: 'id',
                        render: data => {
                            return '<button type="button" class="delete btn btn-danger btn-sm">Delete</button>';
                        }
                    }
                ]
            });

            // Set up event handler
            $('#organizations button.delete').on('click', (e) => {
                // Get button from event
                var button = e.target;
                // Get row using button
                var row = table.row( $(button).parents('tr') );
                // Delete the organization
                this.destroy(row);
            });
        },
        destroyed() {
            $('#organizations button.delete').off('click');
        },
        methods: {
            destroy(row) {
                // Make sure you want to delete the organization
                var r = confirm('Delete the organization?');
                if (r == false) return;

                // Send delete request
                axios.delete('/organizations/' + row.data().id)
                    .then(response => {
                        // Remove the row from the table
                        row.remove().draw();
                    })
                    .catch(error => {
                        alert('There was problem deleting this organization');
                    });
            }
        }
    }
</script>
