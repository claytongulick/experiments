<?php
/* 
 * MySQLComm
 * Native MySQL library for PHP
 * Copyright 2007 Clayton C. Gulick
 * claytongulick@yahoo.com
 *
 * This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 *
 *
 */
///////////////////////////////////////// Defines ///////////////////////////////////////////////////
//CAPABILITY FLAGS//
define('LONG_PASSWORD',1); //New more secure passwords
define('FOUND_ROWS',2); //Found instead of affected rows
define('LONG_FLAG',4); //Get all column flags
define('CONNECT_WITH_DB',8); //One can specify db on connect
define('NO_SCHEMA',16); //Don't allow database.table.column
define('COMPRESS',32); //Can use compression protocol
define('ODBC',64); //ODBC client
define('LOCAL_FILES',128); //Can use LOAD DATA LOCAL
define('IGNORE_SPACE',256); //Ignore spaces before '('
define('PROTOCOL_41',512); //Support the 4.1 protocol
define('INTERACTIVE',1024); //This is an interactive client
define('SSL',2048); //Switch to SSL after handshake
define('IGNORE_SIGPIPE',4096); //IGNORE sigpipes
define('TRANSACTIONS',8192); //Client knows about transactions
define('SECURE_CONNECTION',32768); //New 4.1 authentication
define('MULTI_STATEMENTS',65536); //Multi-statement support
define('MULTI_RESULTS',131072); //Multi-results

//COMMANDS//
define('SLEEP',0);
define('QUIT',1);
define('INIT_DB',2);
define('QUERY',3);
define('FIELD_LIST',4);
define('CREATE_DB',5);
define('DROP_DB',6);
define('REFRESH',7);
define('SHUTDOWN',8);
define('STATISTICS',9);
define('PROCESS_INFO',10);
define('CONNECT',11);
define('PROCESS_KILL',12);
define('DEBUG',13);
define('PING',14);
define('TIME',15);
define('DELAYED_INSERT',16);
define('CHANGE_USER',17);
define('BINLOG_DUMP',18);
define('TABLE_DUMP',19);
define('CONNECT_OUT',20);
define('REGISTER_SLAVE',21);
define('PREPARE',22);
define('EXECUTE',23);
define('LONG_DATA',24);
define('CLOSE_STMT',25);
define('RESET_STMT',26);
define('SET_OPTION',27);

//FIELD TYPES//
define('DECIMAL',0);
define('TINY',1);
define('SHORT',2);
define('LONG',3);
define('FLOAT',4);
define('DOUBLE',5);
define('NULL',6);
define('TIMESTAMP',7);
define('LONGLONG',8);
define('INT24',9);
define('DATE',10);
define('TIME',11);
define('DATETIME',12);
define('YEAR',13);
define('NEWDATE',14);
define('ENUM',247);
define('SET',248);
define('TINY_BLOB',249);
define('MEDIUM_BLOB',250);
define('LONG_BLOB',251);
define('BLOB',252);
define('VAR_STRING',253);
define('STRING',254);
define('GEOMETRY',255);

//STATUS CODES//
define('IN_TRANS',1);
define('AUTOCOMMIT',2);
define('MORE_RESULTS',4);
define('MORE_RESULTS_EXISTS',8);
define('QUERY_NO_GOOD_INDEX_USED',16);
define('QUERY_NO_INDEX_USED',32);

//CHARACTER SETS//
define('big5_chinese_ci',1); define('latin1_general_cs',49);
define('latin2_czech_cs',2); define('cp1251_bin',50);

define('dec8_swedish_ci',3); define('cp1251_general_ci',51);
define('cp850_general_ci',4); define('cp1251_general_cs',52);
define('latin1_german1_ci',5); define('macroman_bin',53);
define('hp8_english_ci',6); define('macroman_ci',54);

define('koi8r_general_ci',7); define('macroman_ci_ai',55);
define('latin1_swedish_ci',8); define('macroman_cs',56);
define('latin2_general_ci',9); define('cp1256_general_ci',57);
define('swe7_swedish_ci',10); define('cp1257_bin',58);

define('ascii_general_ci',11); define('cp1257_general_ci',59);
define('ujis_japanese_ci',12); define('cp1257_ci',60);
define('sjis_japanese_ci',13); define('cp1257_cs',61);
define('cp1251_bulgarian_ci',14); define('binary',63);

define('latin1_danish_ci',15); define('armscii8_bin',64);
define('hebrew_general_ci',16); define('ascii_bin',65);
define('tis620_thai_ci',18); define('cp1250_bin',66);
define('euckr_korean_ci',19); define('cp1256_bin',67);

define('latin7_estonian_cs',20); define('cp866_bin',68);
define('latin2_hungarian_ci',21); define('dec8_bin',69);
define('koi8u_general_ci',22); define('greek_bin',70);
define('cp1251_ukrainian_ci',23); define('hebrew_bin',71);

define('gb2312_chinese_ci',24); define('hp8_bin',72);
define('greek_general_ci',25); define('keybcs2_bin',73);
define('cp1250_general_ci',26); define('koi8r_bin',74);
define('latin2_croatian_ci',27); define('koi8u_bin',75);

define('gbk_chinese_ci',28); define('latin2_bin',77);
define('cp1257_lithuanian_ci',29); define('latin5_bin',78);
define('latin5_turkish_ci',30); define('latin7_bin',79);
define('latin1_german2_ci',31); define('cp850_bin',80);

define('armscii8_general_ci',32); define('cp852_bin',81);
define('utf8_general_ci',33); define('swe7_bin',82);
define('cp1250_czech_cs',34); define('utf8_bin',83);
define('ucs2_general_ci',35); define('big5_bin',84);

define('cp866_general_ci',36); define('euckr_bin',85);
define('keybcs2_general_ci',37); define('gb2312',86);
define('macce_general_ci',38); define('gbk_bin',87);
define('macroman_general_ci',39); define('sjis_bin',88);

define('cp852_general_ci',40); define('tis620_bin',89);
define('latin7_general_ci',41); define('ucs2_bin',90);
define('latin7_general_cs',42); define('ujis_bin',91);
define('macce_bin',43); define('geostd8_general_ci',92);

define('latin1_bin',47); define('geostd8_bin',93);
define('latin1_general_ci',48); define('latin1_spanish_ci',94);

//ERRORS//
define('HASHCHK',1000); define('ABORTING_CONNECTION',1152);
define('NISAMCHK',1001); define('NET_PACKET_TOO_LARGE',1153);
define('NO',1002); define('NET_READ_ERROR_FROM_PIPE',1154);
define('YES',1003); define('NET_FCNTL_ERROR',1155);

define('CANT_CREATE_FILE',1004); define('NET_PACKETS_OUT_OF_ORDER',1156);
define('CANT_CREATE_TABLE',1005); define('NET_UNCOMPRESS_ERROR',1157);
define('CANT_CREATE_DB',1006); define('NET_READ_ERROR',1158);
define('DB_CREATE_EXISTS',1007); define('NET_READ_INTERRUPTED',1159);

define('DB_DROP_EXISTS',1008); define('NET_ERROR_ON_WRITE',1160);
define('DB_DROP_DELETE',1009); define('NET_WRITE_INTERRUPTED',1161);
define('DB_DROP_RMDIR',1010); define('TOO_LONG_STRING',1162);
define('CANT_DELETE_FILE',1011); define('TABLE_CANT_HANDLE_BLOB',1163);

define('CANT_FIND_SYSTEM_REC',1012); define('TABLE_CANT_HANDLE_AUTO_INCREMENT',1164);
define('CANT_GET_STAT',1013); define('DELAYED_INSERT_TABLE_LOCKED',1165);
define('CANT_GET_WD',1014); define('WRONG_COLUMN_NAME',1166);
define('CANT_LOCK',1015); define('WRONG_KEY_COLUMN',1167);

define('CANT_OPEN_FILE',1016); define('WRONG_MRG_TABLE',1168);
define('FILE_NOT_FOUND',1017); define('DUP_UNIQUE',1169);
define('CANT_READ_DIR',1018); define('BLOB_KEY_WITHOUT_LENGTH',1170);
define('CANT_SET_WD',1019); define('PRIMARY_CANT_HAVE_NULL',1171);

define('CHECKREAD',1020); define('TOO_MANY_ROWS',1172);
define('DISK_FULL',1021); define('REQUIRES_PRIMARY_KEY',1173);
define('DUP_KEY',1022); define('NO_RAID_COMPILED',1174);
define('ERROR_ON_CLOSE',1023); define('UPDATE_WITHOUT_KEY_IN_SAFE_MODE',1175);

define('ERROR_ON_READ',1024); define('KEY_DOES_NOT_EXITS',1176);
define('ERROR_ON_RENAME',1025); define('CHECK_NO_SUCH_TABLE',1177);
define('ERROR_ON_WRITE',1026); define('CHECK_NOT_IMPLEMENTED',1178);
define('FILE_USED',1027); define('CANT_DO_THIS_DURING_AN_TRANSACTION',1179);

define('FILSORT_ABORT',1028); define('ERROR_DURING_COMMIT',1180);
define('FORM_NOT_FOUND',1029); define('ERROR_DURING_ROLLBACK',1181);
define('GET_ERRNO',1030); define('ERROR_DURING_FLUSH_LOGS',1182);
define('ILLEGAL_HA',1031); define('ERROR_DURING_CHECKPOINT',1183);

define('KEY_NOT_FOUND',1032); define('NEW_ABORTING_CONNECTION',1184);
define('NOT_FORM_FILE',1033); define('DUMP_NOT_IMPLEMENTED',1185);
define('NOT_KEYFILE',1034); define('FLUSH_MASTER_BINLOG_CLOSED',1186);
define('OLD_KEYFILE',1035); define('INDEX_REBUILD',1187);

define('OPEN_AS_READONLY',1036); define('MASTER',1188);
define('OUTOFMEMORY',1037); define('MASTER_NET_READ',1189);
define('OUT_OF_SORTMEMORY',1038); define('MASTER_NET_WRITE',1190);
define('UNEXPECTED_EOF',1039); define('FT_MATCHING_KEY_NOT_FOUND',1191);

define('CON_COUNT_ERROR',1040); define('LOCK_OR_ACTIVE_TRANSACTION',1192);
define('OUT_OF_RESOURCES',1041); define('UNKNOWN_SYSTEM_VARIABLE',1193);
define('BAD_HOST_ERROR',1042); define('CRASHED_ON_USAGE',1194);
define('HANDSHAKE_ERROR',1043); define('CRASHED_ON_REPAIR',1195);

define('DBACCESS_DENIED_ERROR',1044); define('WARNING_NOT_COMPLETE_ROLLBACK',1196);
define('ACCESS_DENIED_ERROR',1045); define('TRANS_CACHE_FULL',1197);
define('NO_DB_ERROR',1046); define('SLAVE_MUST_STOP',1198);
define('UNKNOWN_COM_ERROR',1047); define('SLAVE_NOT_RUNNING',1199);

define('BAD_NULL_ERROR',1048); define('BAD_SLAVE',1200);
define('BAD_DB_ERROR',1049); define('MASTER_INFO',1201);
define('TABLE_EXISTS_ERROR',1050); define('SLAVE_THREAD',1202);
define('BAD_TABLE_ERROR',1051); define('TOO_MANY_USER_CONNECTIONS',1203);

define('NON_UNIQ_ERROR',1052); define('SET_CONSTANTS_ONLY',1204);
define('SERVER_SHUTDOWN',1053); define('LOCK_WAIT_TIMEOUT',1205);
define('BAD_FIELD_ERROR',1054); define('LOCK_TABLE_FULL',1206);
define('WRONG_FIELD_WITH_GROUP',1055); define('READ_ONLY_TRANSACTION',1207);

define('WRONG_GROUP_FIELD',1056); define('DROP_DB_WITH_READ_LOCK',1208);
define('WRONG_SUM_SELECT',1057); define('CREATE_DB_WITH_READ_LOCK',1209);
define('WRONG_VALUE_COUNT',1058); define('WRONG_ARGUMENTS',1210);
define('TOO_LONG_IDENT',1059); define('NO_PERMISSION_TO_CREATE_USER',1211);

define('DUP_FIELDNAME',1060); define('UNION_TABLES_IN_DIFFERENT_DIR',1212);
define('DUP_KEYNAME',1061); define('LOCK_DEADLOCK',1213);
define('DUP_ENTRY',1062); define('TABLE_CANT_HANDLE_FT',1214);
define('WRONG_FIELD_SPEC',1063); define('CANNOT_ADD_FOREIGN',1215);

define('PARSE_ERROR',1064); define('NO_REFERENCED_ROW',1216);
define('EMPTY_QUERY',1065); define('ROW_IS_REFERENCED',1217);
define('NONUNIQ_TABLE',1066); define('CONNECT_TO_MASTER',1218);
define('INVALID_DEFAULT',1067); define('QUERY_ON_MASTER',1219);

define('MULTIPLE_PRI_KEY',1068); define('ERROR_WHEN_EXECUTING_COMMAND',1220);
define('TOO_MANY_KEYS',1069); define('WRONG_USAGE',1221);
define('TOO_MANY_KEY_PARTS',1070); define('WRONG_NUMBER_OF_COLUMNS_IN_SELECT',1222);
define('TOO_LONG_KEY',1071); define('CANT_UPDATE_WITH_READLOCK',1223);

define('KEY_COLUMN_DOES_NOT_EXITS',1072); define('MIXING_NOT_ALLOWED',1224);
define('BLOB_USED_AS_KEY',1073); define('DUP_ARGUMENT',1225);
define('TOO_BIG_FIELDLENGTH',1074); define('USER_LIMIT_REACHED',1226);
define('WRONG_AUTO_KEY',1075); define('SPECIFIC_ACCESS_DENIED_ERROR',1227);

define('READY',1076); define('LOCAL_VARIABLE',1228);
define('NORMAL_SHUTDOWN',1077); define('GLOBAL_VARIABLE',1229);
define('GOT_SIGNAL',1078); define('NO_DEFAULT',1230);
define('SHUTDOWN_COMPLETE',1079); define('WRONG_VALUE_FOR_VAR',1231);

define('FORCING_CLOSE',1080); define('WRONG_TYPE_FOR_VAR',1232);
define('IPSOCK_ERROR',1081); define('VAR_CANT_BE_READ',1233);
define('NO_SUCH_INDEX',1082); define('CANT_USE_OPTION_HERE',1234);
define('WRONG_FIELD_TERMINATORS',1083); define('NOT_SUPPORTED_YET',1235);

define('BLOBS_AND_NO_TERMINATED',1084); define('MASTER_FATAL_ERROR_READING_BINLOG',1236);
define('TEXTFILE_NOT_READABLE',1085); define('SLAVE_IGNORED_TABLE',1237);
define('FILE_EXISTS_ERROR',1086); define('INCORRECT_GLOBAL_LOCAL_VAR',1238);
define('LOAD_INFO',1087); define('WRONG_FK_DEF',1239);

define('ALTER_INFO',1088); define('KEY_REF_DO_NOT_MATCH_TABLE_REF',1240);
define('WRONG_SUB_KEY',1089); define('OPERAND_COLUMNS',1241);
define('CANT_REMOVE_ALL_FIELDS',1090); define('SUBQUERY_NO_1_ROW',1242);
define('CANT_DROP_FIELD_OR_KEY',1091); define('UNKNOWN_STMT_HANDLER',1243);

define('INSERT_INFO',1092); define('CORRUPT_HELP_DB',1244);
define('UPDATE_TABLE_USED',1093); define('CYCLIC_REFERENCE',1245);
define('NO_SUCH_THREAD',1094); define('AUTO_CONVERT',1246);
define('KILL_DENIED_ERROR',1095); define('ILLEGAL_REFERENCE',1247);

define('NO_TABLES_USED',1096); define('DERIVED_MUST_HAVE_ALIAS',1248);
define('TOO_BIG_SET',1097); define('SELECT_REDUCED',1249);
define('NO_UNIQUE_LOGFILE',1098); define('TABLENAME_NOT_ALLOWED_HERE',1250);
define('TABLE_NOT_LOCKED_FOR_WRITE',1099); define('NOT_SUPPORTED_AUTH_MODE',1251);

define('TABLE_NOT_LOCKED',1100); define('SPATIAL_CANT_HAVE_NULL',1252);
define('BLOB_CANT_HAVE_DEFAULT',1101); define('COLLATION_CHARSET_MISMATCH',1253);
define('WRONG_DB_NAME',1102); define('SLAVE_WAS_RUNNING',1254);
define('WRONG_TABLE_NAME',1103); define('SLAVE_WAS_NOT_RUNNING',1255);

define('TOO_BIG_SELECT',1104); define('TOO_BIG_FOR_UNCOMPRESS',1256);
define('UNKNOWN_ERROR',1105); define('ZLIB_Z_MEM_ERROR',1257);
define('UNKNOWN_PROCEDURE',1106); define('ZLIB_Z_BUF_ERROR',1258);
define('WRONG_PARAMCOUNT_TO_PROCEDURE',1107); define('ZLIB_Z_DATA_ERROR',1259);

define('WRONG_PARAMETERS_TO_PROCEDURE',1108); define('CUT_VALUE_GROUP_CONCAT',1260);
define('UNKNOWN_TABLE',1109); define('WARN_TOO_FEW_RECORDS',1261);
define('FIELD_SPECIFIED_TWICE',1110); define('WARN_TOO_MANY_RECORDS',1262);
define('INVALID_GROUP_FUNC_USE',1111); define('WARN_NULL_TO_NOTNULL',1263);

define('UNSUPPORTED_EXTENSION',1112); define('WARN_DATA_OUT_OF_RANGE',1264);
define('TABLE_MUST_HAVE_COLUMNS',1113); define('WARN_DATA_TRUNCATED',1265);
define('RECORD_FILE_FULL',1114); define('WARN_USING_OTHER_HANDLER',1266);
define('UNKNOWN_CHARACTER_SET',1115); define('CANT_AGGREGATE_2COLLATIONS',1267);

define('TOO_MANY_TABLES',1116); define('DROP_USER',1268);
define('TOO_MANY_FIELDS',1117); define('REVOKE_GRANTS',1269);
define('TOO_BIG_ROWSIZE',1118); define('CANT_AGGREGATE_3COLLATIONS',1270);
define('STACK_OVERRUN',1119); define('CANT_AGGREGATE_NCOLLATIONS',1271);

define('WRONG_OUTER_JOIN',1120); define('VARIABLE_IS_NOT_STRUCT',1272);
define('NULL_COLUMN_IN_INDEX',1121); define('UNKNOWN_COLLATION',1273);
define('CANT_FIND_UDF',1122); define('SLAVE_IGNORED_SSL_PARAMS',1274);
define('CANT_INITIALIZE_UDF',1123); define('SERVER_IS_IN_SECURE_AUTH_MODE',1275);

define('UDF_NO_PATHS',1124); define('WARN_FIELD_RESOLVED',1276);
define('UDF_EXISTS',1125); define('BAD_SLAVE_UNTIL_COND',1277);
define('CANT_OPEN_LIBRARY',1126); define('MISSING_SKIP_SLAVE',1278);
define('CANT_FIND_DL_ENTRY',1127); define('UNTIL_COND_IGNORED',1279);

define('FUNCTION_NOT_DEFINED',1128); define('WRONG_NAME_FOR_INDEX',1280);
define('HOST_IS_BLOCKED',1129); define('WRONG_NAME_FOR_CATALOG',1281);
define('HOST_NOT_PRIVILEGED',1130); define('WARN_QC_RESIZE',1282);
define('PASSWORD_ANONYMOUS_USER',1131); define('BAD_FT_COLUMN',1283);

define('PASSWORD_NOT_ALLOWED',1132); define('UNKNOWN_KEY_CACHE',1284);
define('PASSWORD_NO_MATCH',1133); define('WARN_HOSTNAME_WONT_WORK',1285);
define('UPDATE_INFO',1134); define('UNKNOWN_STORAGE_ENGINE',1286);
define('CANT_CREATE_THREAD',1135); define('WARN_DEPRECATED_SYNTAX',1287);

define('WRONG_VALUE_COUNT_ON_ROW',1136); define('NON_UPDATABLE_TABLE',1288);
define('CANT_REOPEN_TABLE',1137); define('FEATURE_DISABLED',1289);
define('INVALID_USE_OF_NULL',1138); define('OPTION_PREVENTS_STATEMENT',1290);
define('REGEXP_ERROR',1139); define('DUPLICATED_VALUE_IN_TYPE',1291);

define('MIX_OF_GROUP_FUNC_AND_FIELDS',1140); define('TRUNCATED_WRONG_VALUE',1292);
define('NONEXISTING_GRANT',1141); define('TOO_MUCH_AUTO_TIMESTAMP_COLS',1293);
define('TABLEACCESS_DENIED_ERROR',1142); define('INVALID_ON_UPDATE',1294);
define('COLUMNACCESS_DENIED_ERROR',1143); define('UNSUPPORTED_PS',1295);

define('ILLEGAL_GRANT_FOR_TABLE',1144); define('GET_ERRMSG',1296);
define('GRANT_WRONG_HOST_OR_USER',1145); define('GET_TEMPORARY_ERRMSG',1297);
define('NO_SUCH_TABLE',1146); define('UNKNOWN_TIME_ZONE',1298);
define('NONEXISTING_TABLE_GRANT',1147); define('WARN_INVALID_TIMESTAMP',1299);

define('NOT_ALLOWED_COMMAND',1148); define('INVALID_CHARACTER_STRING',1300);
define('SYNTAX_ERROR',1149); define('WARN_ALLOWED_PACKET_OVERFLOWED',1301);
define('DELAYED_CANT_CHANGE_LOCK',1150); define('CONFLICTING_DECLARATIONS',1302);
define('TOO_MANY_DELAYED_THREADS',1151);

//FIELD FLAGS//
define('NOT_NULL',1); //Field can't be NULL
define('PRI_KEY',2); //Field is part of a primary key
define('UNIQUE_KEY',4); //Field is part of a unique key
define('MULTIPLE_KEY',8); //Field is part of a key
define('BLOB',16); //Field is a blob
define('UNSIGNED',32); //Field is unsigned
define('ZEROFILL',64); //Field is zerofill
define('BINARY',128); //Field is binary
define('ENUM',256); //Field is an enum
define('AUTO_INCREMENT',512); //Field is an autoincrement field
define('TIMESTAMP',1024); //Field is a timestamp
define('SET',2048); //Field is a set
define('NUM',32768); //Field is num (for clients)

////////////////////////////////////////////////////////////////////////////////////////////////////
class MySQLComm
{

    var $server;
    var $userName;
    var $password;
    var $port;
    var $timeout;

    var $sock;
    var $serverInfo;
    var $lastError;

    var $connected;

    function MySQLComm($serverName, $userName, $password, $port=3306,$timeout=10)
    {
        $this->server=$serverName;
        $this->userName=$userName;
        $this->password=$password;
        $this->port=$port;
        $this->timeout=$timeout;
        $this->lastError=null;

    }


    function Query($sql)
    {
        $cmd=new MySQLCommand();
        $cmd->command=QUERY;
        $cmd->commandArgs=$sql;
        $cmd->send($this->sock);

        $p=new MySQLPacket();
        $p->read($this->sock);
        if($p->packetType=="ERR")
        {
            $this->lastError=new MySQLError($p);
            return(false);
        }
        if($p->packetType=="OK")
        {
            return(true);
        }

        $resp=new MySQLResultSet($p);

        $resp->read($this->sock);

        return($resp);

        //print_r($resp);

    }


    function Connect()
    {
        //$this->sock=fsockopen($this->server,$this->port,$errNumber,$errMsg,$timeout);
        $this->sock=socket_create(AF_INET,SOCK_STREAM,getprotobyname('tcp'));
        if(!$this->sock)
        {
            echo('Failed to create socket: '.socket_strerror(socket_last_error($this->sock)));
            return(false);
        }
        $ip = gethostbyname($this->server);
        if(!$ip)
        {
            echo('Failed to obtain ip address for: '.$this->server.socket_strerror(socket_last_error($this->sock)));
            return(false);
        }

        if(!socket_connect($this->sock,$ip,$this->port))
        {
            echo('Failed to connect to '.$ip.' on port '.$this->port.': '.socket_strerror(socket_last_error($this->sock)));
            return(false);
        }



        $p = new MySQLPacket();
        $p->read($this->sock);
        //print_r($p);

        $this->serverInfo = new MySQLServerInfo($p);
        //print_r($this->serverInfo);
        $ret=$this->Authenticate();
        if($ret===true)
        {
            $this->connected=true;
            return(true);
        }
        else
        {
            $this->Disconnect();
            return(false);
        }

    }

    function Authenticate()
    {
        $p=new MySQLPacket();
        $caps=LONG_PASSWORD | LONG_FLAG | TRANSACTIONS | INTERACTIVE | LOCAL_FILES | PROTOCOL_41 | MULTI_RESULTS | SECURE_CONNECTION; //not doing SECURE_CONNECTION to avoid ssl. maybe in a future version.
        $p->body=pack('V',$caps); //4 bytes for client caps
        $maxPacketSize=1073741824;//pow(2,24); //about 16 megs for our max size
        $p->body.=pack('V',$maxPacketSize); //4 bytes for max packet size
        $p->body.=chr(33); //33 = utf8 // --using charset 08 - latin - one byte for char set
        //add 23 bytes of null padding
        for($i=0;$i<23;$i++){$p->body.=chr(0);} //23 bytes of null padding
        $p->body.=$this->userName;
        $p->body.=chr(0); //user name is null terminated string

        //add a null for password to test handshake
        //$p->body.=chr(0);
        $pwdHash=$this->hashPassword($this->password);
        //echo($pwdHash);
        $p->body.=chr(20); //password hash will always be 20 bytes
        $p->body.=$pwdHash;

        $p->index=1;
        $p->send($this->sock);

        $rec = new MySQLPacket();
        $rec->read($this->sock);

        if($rec->packetType=="OK")
        {
            return(true);
        }
        else
        {
            if($rec->packetType=="ERR")
            {
                $err=new MySqlError($packet);
                $this->lastError=$err;
                return(false);
            }
            else
            {
                trigger_error("Unknown server response, handshake error",0);
            }
        }

    }

    function hashPassword($password)
    {
        //$strSalt="65576165565d505b592c6f6b4b72224a335c567c"; //for debugging purposes
        //$strSalt=pack('H*',$strSalt);
        //$this->serverInfo->salt=$strSalt;

        //9d 4b 27 04 21 db da e1 45 cd cf 91 14 1e b7 f8 ff be 8e 89          //using the above salt, this is what the hash should be for password "honor"
        //
        $strTemp=unpack('H*',$this->serverInfo->salt);
        //print_r($strTemp);

        $hash='';
        $hash1=pack('H*', sha1($password));
        //echo("|1|$hash1");
        $hash2=pack('H*', sha1($hash1));
        //echo("|2|$hash2");
        $hash3 = $this->serverInfo->salt.$hash2;
        //echo("||{$this->serverInfo->salt}||$hash2||$hash3");
        //echo("|3a|$hash3");
        $hash3=pack('H*', sha1($hash3));
        //echo("|3b|$hash3");

        $hash4=$hash1^$hash3;

        //echo("$hash4");
        //exit();

        //echo("|4|$hash4::");

        return($hash4);
        /*$arHash1=unpack("C*",$hash1);
        $arHash3=unpack("C*",$hash3);
        //print_r($arHash1);
        $hash4=null;
        foreach($arHash1 as $key=>$val)
        {
            $ch = (int)$arHash3["$key"];
            $ch1 =  (int)$ch ^ (int)$val;
            //echo("||$ch||$val||$ch1||");
            //$ch=$this->binxor($val, $ch);
            $hash4.=chr($ch1);
        }*/
    }

    function binxor($a, $b) {
        return bindec(decbin((float)$a ^ (float)$b));
    }

    function Disconnect()
    {
        //need to pretty this up - send an actual "quit" message
        socket_close($this->sock);
        $this->connected=false;
    }

}


class MySQLFLEField
{
    var $length;
    var $value;
}

class MySQLMetaDataField
{
    var $database;
    var $tableAlias;
    var $table;
    var $columnAlias;
    var $column;
    var $characterSet;
    var $length;
    var $type;
    var $fieldOptions;
    var $precision;
    var $defaultValue;
    var $isNotNull;
    var $isPrimaryKey;
    var $isUniqueKey;
    var $isMultipleKey;
    var $isBlob;
    var $isUnsigned;
    var $isZerofill;
    var $isBinary;
    var $isEnum;
    var $isAutoIncrement;
    var $isTimestamp;
    var $isSet;
    var $isNumeric; 

}

class MySQLResultSet
{
    var $numFields;
    var $arMetaDataPackets;
    var $arRowDataPackets;

    var $metaData;
    var $rows;


    function MySQLResultSet($firstPacket)
    {
        $this->arMetaDataPackets=array();
        $this->arRowDataPackets=array();
        $this->metaData=array();
        $this->rows=array();

        $arTemp = $this->decodeFLE($firstPacket->body);
        //this is a trick packet, it only contains the number of fields that will be sent, no data in the FLE
        //so if there is more than one field, something is messed up
        if(count($arTemp)<>1)
        {
            trigger_error("Invalid result set, header packet contains incorrect number of fields");
            return(false);
        }
        $this->numFields=$arTemp[0]->length;

    }

    function decodeFLE($body)
    {
        $offset=0;
        $len=strlen($body);
        $arFields = array();


        while($offset<$len)
        {
            $fld=new MySQLFLEField();
            $firstByte=ord(substr($body,$offset,1));
            if($firstByte<251) //this is a one byte length. Grab the value and continue
            {
                $fld->length=$firstByte;
                $offset++;
                $fld->value=substr($body,$offset,$fld->length);
                $offset+=$fld->length;
                $arFields[]=$fld;
                continue;
            }
            elseif($firstByte==251) //null field
            {
                $fld->length=0;
                $fld->value=null;
                $offset++;
                $arFields[]=$fld;
                continue;
            }
            elseif($firstByte==252) //two byte length
            {
                $offset++; //skip the byte code
                $fld->length=unpack('v',substr($body,$offset,2));
                $offset+=2;
                $fld->value=substr($body,$offset,$fld->length);
                $offset+=$fld->length;
                $arFields[]=$fld;
                continue;
            }
            elseif($firstByte==253) //four byte length
            {
                $offset++; //skip the code
                $fld->length=unpack('V',substr($body,$offset,4));
                $offset+=4;
                $fld->value=substr($body,$offset,$fld->length);
                $offset+=$fld->length;
                $arFields[]=$fld;
                continue;
            }
            elseif($firstByte==254) //eight byte length, throw error for now -- need to implement this later
            {
                trigger_error("Max field size exceeded. This PHP client only supports 32 bit field sizes.",0);
                return(false);
            }
            else
            {
                trigger_error("Invalid field size: $firstByte");
                return(false);
            }
        }

        return($arFields);

    }

    function read($sock)
    {
        //read the metadata in. There should be exaclty as many rows as this->numFields describing each field
        if($this->numFields <=0)
        {
            trigger_error("Invalid field count retreiving result set");
            return(false);
        }

        for($i=0;$i<$this->numFields;$i++)
        {
            $p=new MySQLPacket();
            $p->read($sock);

            if($p->packetType=="ERR")
            {
                $err=new MySQLError($p);
                trigger_error($err->errorCode.":".$err->errorMessage);
                return(false);
            }
            elseif($p->packetType=="EOF")
            {
                trigger_error("Unexpected EOF retreiving metadata");
                return(false);
            }
            elseif($p->packetType=="OK")
            {
                trigger_error("Invalid packet received while retreiving metadata");
                return(false);
            }
            else
            {
                //santity check here
                if($i>1000)
                {
                    trigger_error("max packet count exceeded while retreiving metadata");
                    return(false);
                }
                $this->arMetaDataPackets[]=$p;
            }

        }//end while

        //now we should receive an EOF, to indicate the metadata is done
        $p=new MySQLPacket();
        $p->read($sock);
        if($p->packetType != "EOF")
        {
            trigger_error("Invalid packet received while retreiving result set, expected EOF");
            return(false);
        }

        $i=0;
        //now read the value rows
        while(true)
        {
            $p=new MySQLPacket();
            $p->read($sock);

            if($p->packetType=="ERR")
            {
                $err=new MySQLError($p);
                trigger_error($err->errorCode.":".$err->errorMessage);
                return(false);
            }
            elseif($p->packetType=="EOF")
            {
                //echo("EOF\n");
                break; //all done
            }
            elseif($p->packetType=="OK")
            {
                echo("OK\n");
                trigger_error("Invalid packet received while retreiving rows");
                return(false);
            }
            else
            {
                //santity check here
                if($i>1000000)
                {
                    trigger_error("max row count exceeded");
                    return(false);
                }
                $i++;
                $this->arRowDataPackets[]=$p;
            }

        }

        //now that we;ve gathered our packets, its time to parse into logical structures
        //first the meta data
        foreach($this->arMetaDataPackets as $p)
        {
            $arTemp=$this->decodeFLE($p->body);
            //print_r($arTemp);
            $m=new MySQLMetaDataField();
            $temp=$arTemp[0]->value;
            if($temp != "def")
            {
                trigger_error("invalid meta data row detected");
                return(false);
            }
            $m->database=$arTemp[1]->value;
            $m->tableAlias=$arTemp[2]->value;
            $m->table=$arTemp[3]->value;
            $m->columnAlias=$arTemp[4]->value;
            $m->column=$arTemp[5]->value;
            $m->characterSet=unpack('v',substr($arTemp[6]->value,1,2));
            $m->characterSet=$m->characterSet[1];
            $m->length=unpack('V',substr($arTemp[6]->value,4,4));
            $m->length=$m->length[1];
            $m->type=ord(substr($arTemp[6]->value,8,1));
            $m->fieldOptions=unpack('v',substr($arTemp[6]->value,9,2));
            $m->fieldOptions=$m->fieldOptions[1];
            $m->precision=ord(substr($arTemp[6]->value,11,1));
            $m->defaultValue=$arTemp[7]->value;

            //decode the field options into booleans to make life easier
            $m->isNotNull=$m->fieldOptions & NOT_NULL;
            $m->isPrimaryKey=$m->fieldOptions & PRI_KEY;
            $m->isUniqiueKey=$m->fieldOptions & UNIQUE_KEY;
            $m->isMultipleKey=$m->fieldOptions & MULTIPLE_KEY;
            $m->isBlob=$m->fieldOptions & BLOB;
            $m->isUnsigned=$m->fieldOptions & UNSIGNED;
            $m->isZerofill=$m->fieldOptions & ZEROFILL;
            $m->isBinary=$m->fieldOptions & BINARY;
            $m->isEnum=$m->fieldOptions & ENUM;
            $m->isAutoIncrement=$m->fieldOptions & AUTO_INCREMENT;
            $m->isTimestamp=$m->fieldOptions & TIMESTAMP;
            $m->isSet=$m->fieldOptions & SET;
            $m->isNum=$m->fieldOptions & NUM;

            $this->metaData[]=$m;

        }
        
        $packet_count=count($this->arRowDataPackets);
        //now parse the rows into a nice array
        foreach($this->arRowDataPackets as $p)
        {
        
            $t=$this->arRowDataPackets[$i];
            $arTemp=$this->decodeFLE($p->body);
            $row = array();

            //print_r($arTemp);

            for($j=0;$j<count($arTemp);$j++)
            {
                $m=$this->metaData[$j];
                $row["{$m->columnAlias}"]=$arTemp[$j]->value;
            }
            $this->rows[]=$row;
        }

        //free up some memory
        unset($this->arMetaDataPackets);
        unset($this->arRowDataPackets);

    }//end read
}//end MySQLResponse

class MySQLCommand
{
    var $command;
    var $commandArgs;

    function MySQLCommand()
    {
    }

    function send($sock)
    {
        $packet=new MySQLPacket();
        $packet->index=0;
        $packet->body=chr($this->command);
        $packet->body.=$this->commandArgs;
        $packet->send($sock);
    }

}
class MySQLPacket
{
    var $size;
    var $index;
    var $body;

    var $packetType;

    function getNullTerminatedString($offset)
    {
        $strTemp = substr($this->body,$offset,1);

        while(ord($strTemp)>0)
        {
            if($offset > 500000)
            {
                echo("failed sanity check parsing null terminated string");
                return; //sanity check
            }
            $strRet.=$strTemp;
            $offset++;
            $strTemp=substr($this->body,$offset,1);
        }
        return($strRet);
    }

    function read($sock)
    {
        $tmp = socket_read($sock,3,PHP_BINARY_READ);
        //append a 0 to the end of this so we can unpack it into a 32bit int, since 3 bytes is only 24bit. doh.
        $tmp.=chr(0);
        $this->size=unpack('V',$tmp);
        $this->size=$this->size[1]; //unpack stores the result in an array, 1 based


        //get the packet number
        $this->index=socket_read($sock,1,PHP_BINARY_READ);
        $this->index=ord($this->index);

        //read the packet body
        $this->body=socket_read($sock,$this->size);

        $tmp=ord(substr($this->body,0,1));
        if($tmp==0)
        {
            $this->packetType="OK";
        }
        elseif($tmp==255)
        {
            $this->packetType="ERR";
        }
        elseif($tmp==254)
        {
            $this->packetType="EOF";
        }
        else
        {
            $this->packetType="RESP";
        }
    }

    function send($sock)
    {
        $this->size=strlen($this->body);
        //echo("Size: {$this->size}");
        $packet=pack('V',$this->size);
        //chop off the last byte to make this a 24bit value
        $packet=substr($packet,0,3);
        $packet.=chr($this->index);
        $packet.=$this->body;
        //echo("$packet");
        socket_write($sock,$packet);
    }
}

class MySQLError
{
    var $errorCode;
    var $errorMessage;

    function MySQLError($packet)
    {
        $packetPointer=1; //skip the first byte, its a "FF", indicating error
        $errorCode=unpack('v',substr($packet->body, $packetPointer,2));
        $packetPointer+=2;
        $errorMessage=substr($packet->body, $packetPointer);
    }
}

class MySQLServerInfo
{
    var $protocolVersion;
    var $serverVersion;
    var $threadID;
    var $serverCaps;
    var $characterSet;
    var $status;
    var $salt;

    function MySQLServerInfo($packet)
    {
        //echo($packet->body);
        $packetPointer=0;
        //parse the server info from the connect packet
        $this->protocolVersion=ord(substr($packet->body,$packetPointer,1));
        $packetPointer++;
        $this->serverVersion=$packet->getNullTerminatedString($packetPointer);
        $packetPointer+=strlen($this->serverVersion) + 1; //add one to account for the null terminator
        //echo("pp: $packetPointer");
        $this->threadID=unpack('V',substr($packet->body, $packetPointer, 4));
        $this->threadID=$this->threadID[1]; //unpack puts the results in a 1 based array
        $packetPointer+=4;
        $this->salt=substr($packet->body, $packetPointer, 8); //read 8 bytes ignore null 0 at the end

        $packetPointer+=8 + 1; //add an additional 1 here for null terminated string
        $this->serverCaps=unpack('v',substr($packet->body, $packetPointer, 2));
        $this->serverCaps=$this->serverCaps[1];
        $packetPointer+=2;
        $this->characterSet=ord(substr($packet->body, $packetPointer, 1));
        $packetPointer++;
        $this->status=unpack('v',substr($packet->body,$packetPointer,2));
        $this->status=$this->status[1];
        $packetPointer+=2; //2 bytes for the status
        //13 bytes of padding
        $packetPointer+=13;
        if(($packet->size - $packetPointer) >= 12) //check to see if there's more salt
        {
            $this->salt .= substr($packet->body,$packetPointer,12); //read 12 bytes ignore null 0 at the end
        }
    }
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
//unit test
$m=new MySQLComm('localhost','root','');
$m->Connect();
$m->Query("use Test");
$rs=$m->Query("select * from test_table;");
print_r($rs);
//$m->Query("be test_table");
$m->Disconnect();
 */
?>
