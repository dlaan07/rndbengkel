<div class="card elevation-5">
    <div class="card-body">
        <!-- Tabel daftar order  -->
        <div class="table-responsive">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bengkel</th>
                        <th>Total Order</th>
                        <th>Total Perbaikan Proses</th>
                        <th>Total Perbaikan Selesai</th>
                        <th>Total Perbaikan Batal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($bengkel as $data) { //$order di ambil dari controller Admin nama file order nama function index
                        // if ($data['order_status'] < 8) {
                        $idbengkel = $data['bengkel_id'];
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data['bengkel_nama'] ?></td>
                            <td>
                                <?php
                                $order = $this->db->query("SELECT * from repair_order where order_bengkel = $idbengkel");
                                $jml_order = $order->num_rows();
                                echo $jml_order . " Order";
                                ?>
                            </td>
                            <td>
                                <?php
                                $order = $this->db->query("SELECT * from repair_order where order_bengkel = $idbengkel and order_status !=6 and order_status != 9");
                                $jml_proses = $order->num_rows();
                                echo $jml_proses . " Dalam Proses";
                                ?>
                            </td>
                            <td>
                                <?php
                                $order = $this->db->query("SELECT * from repair_order where order_bengkel = $idbengkel and order_status = 9");
                                $jml_selesai = $order->num_rows();
                                echo $jml_selesai . " Perbaikan Selesai";
                                ?>
                            </td>
                            <td>
                                <?php
                                $order = $this->db->query("SELECT * from repair_order where order_bengkel = $idbengkel and order_status = 6");
                                $jml_cancel = $order->num_rows();
                                echo $jml_cancel . " Perbaikan Batal";
                                ?>
                            </td>

                        </tr>
                    <?php
                        // }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Batas akhir tabel order  -->
    </div>
</div>