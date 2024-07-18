<?php 
function has_permission($role,$permision){
global $mysqli;
$stmt = $mysqli->prepare("
SELECT COUNT(*) FROM role_permissions rp
JOIN roles r ON rp.role_id = r.id
JOIN permissions p ON rp.permission_id = p.id
WHERE r.role_name = ? AND p.permission_name = ?
");

$stmt->bind_param("ss",$role,$permision);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
return $count > 0 ;
}
?>