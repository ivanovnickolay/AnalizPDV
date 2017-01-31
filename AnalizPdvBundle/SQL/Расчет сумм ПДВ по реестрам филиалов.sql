SELECT rbi.month, rbi.year, rbi.num_branch ,SUM(rbi.pdv_20+rbi.pdv_7+rbi.pdv_0+rbi.pdv_zvil+rbi.pdv_ne_gos+rbi.pdv_za_mezhi) AS PDV_In FROM ReestrBranch_in rbi
  GROUP BY rbi.month, rbi.year, rbi.num_branch;

SELECT rbi.month, rbi.year, rbi.num_branch ,SUM(rbi.pdv_20+rbi.pdv_7) AS PDV_Out FROM reestrbranch_out  rbi
  GROUP BY rbi.month, rbi.year, rbi.num_branch;