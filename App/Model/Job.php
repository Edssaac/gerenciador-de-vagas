<?php

namespace App\Model;

use App\Model;
use PDO;

class Job extends Model
{
    public function register(array $data): bool
    {
        $data["date"] = date("Y-m-d H:i:s");

        $result = $this->query(
            "INSERT INTO job (
                user_id, title, description, status, date
            ) VALUES (
                :user_id, :title, :description, :status, :date
            )",
            $this->mapToBind([
                "user_id" => $data["user_id"],
                "title" => $data["title"],
                "description" => $data["description"],
                "status" => $data["status"],
                "date" => $data["date"]
            ])
        );

        return true;
    }

    public function update(array $data): bool
    {
        $data["date"] = date("Y-m-d H:i:s");

        $result = $this->query(
            "UPDATE job SET
                    title = :title,
                    description = :description,
                    status = :status,
                    date = :date
                WHERE id = :id
            ",
            $this->mapToBind($data)
        );

        return true;
    }

    public function remove(int $id): bool
    {
        $result = $this->query(
            "DELETE FROM job 
                WHERE id = :id
            ",
            $this->mapToBind(["id" => $id])
        );

        return true;
    }

    public function getJob(int $id): array
    {
        $result = $this->query(
            "SELECT id, user_id, title, description, status, date FROM job
                WHERE id = :id
            ",
            $this->mapToBind(["id" => $id])
        );

        $job = $result->fetch(PDO::FETCH_ASSOC);

        return ($result->rowCount()) ? $job : [];
    }

    public function getJobs(array $filters): array
    {
        $where = "WHERE id IS NOT NULL";

        if (isset($filters["title"])) {
            $where .= " AND title LIKE CONCAT("%", :title, "%")";
        }

        if (isset($filters["status"])) {
            $where .= " AND status = :status";
        }

        if (isset($filters["offset"])) {
            $offset = $filters["offset"];
            unset($filters["offset"]);
        } else {
            $offset = 0;
        }

        if (isset($filters["limit"])) {
            $limit = $filters["limit"];
            unset($filters["limit"]);
        } else {
            $limit = $_ENV["PAGINATION_LIMIT"];
        }

        $result = $this->query(
            "SELECT id, user_id, title, description, status, date FROM job 
                $where 
                ORDER BY id DESC
                LIMIT $offset, $limit
            ",
            $this->mapToBind($filters)
        );

        $jobs = $result->fetchAll(PDO::FETCH_ASSOC) ?? [];

        return $jobs;
    }

    public function getTotalJobs(): int
    {
        $result = $this->query(
            "SELECT COUNT(id) as total FROM job"
        );

        $job = $result->fetch(PDO::FETCH_ASSOC);

        if (isset($job["total"])) {
            return (int) $job["total"];
        }

        return 0;
    }
}
