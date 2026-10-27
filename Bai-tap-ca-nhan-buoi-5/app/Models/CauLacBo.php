<?php

require_once __DIR__ . '/../Core/ket_noi_csdl.php';

class CauLacBo
{
    private PDO $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Lay danh sach cau lac bo
    public function layDanhSach(): array
    {
        $sql = "
            SELECT
                clb.id,
                clb.ten_cau_lac_bo,
                clb.mo_ta,
                clb.nguoi_quan_ly_id,
                clb.ngay_tao,
                nd.ho_ten AS ten_nguoi_quan_ly
            FROM cau_lac_bo clb
            LEFT JOIN nguoi_dung nd
                ON clb.nguoi_quan_ly_id = nd.id
            ORDER BY clb.id DESC
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    // Tim cau lac bo theo ID
    public function timTheoId(int $id): array|false
    {
        $sql = "
            SELECT *
            FROM cau_lac_bo
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    // Them cau lac bo
    public function them(
        string $ten,
        ?string $moTa,
        ?int $nguoiQuanLyId
    ): bool {
        $sql = "
            INSERT INTO cau_lac_bo
                (ten_cau_lac_bo, mo_ta, nguoi_quan_ly_id)
            VALUES
                (:ten, :mo_ta, :nguoi_quan_ly_id)
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'ten' => trim($ten),
            'mo_ta' => $moTa,
            'nguoi_quan_ly_id' => $nguoiQuanLyId
        ]);
    }

    // Cap nhat cau lac bo
    public function capNhat(
        int $id,
        string $ten,
        ?string $moTa,
        ?int $nguoiQuanLyId
    ): bool {
        $sql = "
            UPDATE cau_lac_bo
            SET ten_cau_lac_bo = :ten,
                mo_ta = :mo_ta,
                nguoi_quan_ly_id = :nguoi_quan_ly_id
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'ten' => trim($ten),
            'mo_ta' => $moTa,
            'nguoi_quan_ly_id' => $nguoiQuanLyId
        ]);
    }

    // Xoa cau lac bo
    public function xoa(int $id): bool
    {
        $sql = "
            DELETE FROM cau_lac_bo
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }
}