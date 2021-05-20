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
                        <th>Par</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($part as $data) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td>PART-00<?= $data['partMaster_id'] ?></td>
                            <td><?= $data['partMaster_nama'] ?></td>
                            <td>Rp <?= number_format($data['partMaster_harga'], 0, "", ".") ?></td>
                            <td><?php if($data['partMaster_stok'] <= 0) { echo '<span class="badge badge-danger">Out Of Stok</span>';} else { echo $data['partMaster_stok']; } ?></td>
                            <td><?= $data['partMaster_par'] ?></td>
                            <td><?= $data['partMaster_profit'] ?></td>
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