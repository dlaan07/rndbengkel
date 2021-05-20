<div class="card elevation-5">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bengkel</th>
                        <th>Total Parts</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($bengkel as $data) {
                        $idbengkel = $data['bengkel_id'];
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data['bengkel_nama'] ?></td>
                            <td>
                                <?php
                                $part = $this->db->query("select * from partmaster where partMaster_bengkel = $idbengkel");
                                $jml_part = $part->num_rows();
                                echo $jml_part;
                                ?>
                            </td>
                            <td>
                                <a href="<?= base_url('Master/Parts/detail/') . $data['bengkel_id'] ?>" class="btn btn-info btn-md">
                                    <li class="fas fa fa-eye"></li>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Batas akhir tabel order  -->
    </div>
</div>