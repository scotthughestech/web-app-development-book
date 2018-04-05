<template>
    <table id="organizations" class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">Country</th>
                <th scope="col">Type</th>
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
            $('#organizations').DataTable({
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
                    }
                ]
            });
        }
    }
</script>
