<div class="card elevation-5">
    <div class="card-body">
        <!-- Tabel daftar pelanggan  -->
        <table id="example1" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>HP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($pelanggan as $data) { //$pelanggan di ambil dari controller Admin nama file pelanggan nama function index
                    $no++;
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td>PLGN-00<?= $data['pelanggan_id'] ?></td>
                        <td><?= $data['pelanggan_nama'] ?></td>
                        <td><?= $data['pelanggan_alamat'] ?></td>
                        <td><?= $data['pelanggan_email'] ?></td>
                        <td><?= $data['pelanggan_hp'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- Batas akhir tabel pelanggan  -->
    </div>
</div>