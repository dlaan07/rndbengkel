<div class="col-md-12 col-sm-12">
    <div class="card elevation-5">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Part</th>
                            <th>Nama Part</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($part as $data) { //$order di ambil dari controller Admin nama file order nama function index

                            $no++;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td>PART-00<?= $data['partMaster_id'] ?></td>
                                <td><?= $data['partMaster_nama'] ?></td>
                                <td><?= $data['partMaster_harga'] ?></td>
                                <td><?php if($data['partMaster_stok'] <= 0) { echo '<span class="badge badge-danger">Out Of Stok</span>';} else { echo $data['partMaster_stok']; } ?></td>
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
</div>