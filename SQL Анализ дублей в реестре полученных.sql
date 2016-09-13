SELECT
  rbi.key_field,rbi.num_branch,
  COUNT(rbi.key_field) AS expr1
FROM ReestrBranch_in rbi
 GROUP BY rbi.key_field,rbi.num_branch
ORDER BY expr1 DESC;
    