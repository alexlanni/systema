-- configure the connection to the master
--
CHANGE MASTER TO
    MASTER_HOST='datastoremaster',
    MASTER_USER='replicant',
    MASTER_PASSWORD='Systema000',
    MASTER_PORT=3306,
    MASTER_USE_GTID=slave_pos,
    MASTER_CONNECT_RETRY=10;

-- start the slave
--
START SLAVE;