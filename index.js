// Importar paquetes necesarios
const mysql = require('mysql');
const express = require('express');
const bodyParser = require('body-parser');

// Crear la aplicación de Express
const app = express();

// Configurar middleware para parsear JSON
app.use(bodyParser.json());

// Configurar conexión a la base de datos MySQL
const mysqlConnection = mysql.createConnection({
    host: '142.44.161.115',
    user: '1901Pro4PAC3equi1',
    password: '1901Pro4PAC3equi1#89',
    database: '1901Pro4PAC3equi1',
    multipleStatements: true,
    port: 3306
});

// Conectar a la base de datos
mysqlConnection.connect((err) => {
    if (!err) {
        console.log('Conexión exitosa');
    } else {
        console.error('Error al conectar a la DB:', err);
    }
});

// Rutas para VENTA_PRODUCTOS
app.post('/ventas-productos/insertar', (req, res) => {
    const { COD_CLIENTE, FEC_VENTA, TOTAL, METODO_PAGO } = req.body;

    mysqlConnection.query(
        'CALL INS_VENTA_PRODUCTOS(?, ?, ?, ?)',
        [COD_CLIENTE, FEC_VENTA, TOTAL, METODO_PAGO],
        (err, results) => {
            if (err) {
                console.error('Error al insertar en VENTA_PRODUCTOS:', err.message);
                return res.status(500).json({ message: 'Error al insertar los datos', error: err.message });
            }
            res.json({ message: 'Inserción realizada correctamente en VENTA_PRODUCTOS.' });
        }
    );
});

app.put('/ventas-productos/actualizar', (req, res) => {
    const { COD_VENTA, COD_CLIENTE, FEC_VENTA, TOTAL, METODO_PAGO } = req.body;

    mysqlConnection.query(
        'CALL UPD_VENTA_PRODUCTOS(?, ?, ?, ?, ?)',
        [COD_VENTA, COD_CLIENTE, FEC_VENTA, TOTAL, METODO_PAGO],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar en VENTA_PRODUCTOS:', err.message);
                return res.status(500).json({ message: 'Error al actualizar los datos', error: err.message });
            }
            res.json({ message: 'Actualización realizada correctamente en VENTA_PRODUCTOS.' });
        }
    );
});

app.get('/ventas-productos/seleccionar', (req, res) => {
    const { COD_VENTA } = req.query;

    mysqlConnection.query(
        'CALL SEL_VENTA_PRODUCTOS(?)',
        [COD_VENTA],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar en VENTA_PRODUCTOS:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar los datos', error: err.message });
            }
            res.json(results[0]);
        }
    );
});

// Rutas para VENTA_PRODUCTOS_DETALLES
app.post('/ventas-productos-detalles/insertar', (req, res) => {
    const { COD_VENTA, COD_PRODUCTO, CANTIDAD, PRECIO } = req.body;

    mysqlConnection.query(
        'CALL INS_VENTA_PRODUCTOS_DETALLES(?, ?, ?, ?)',
        [COD_VENTA, COD_PRODUCTO, CANTIDAD, PRECIO],
        (err, results) => {
            if (err) {
                console.error('Error al insertar en VENTA_PRODUCTOS_DETALLES:', err.message);
                return res.status(500).json({ message: 'Error al insertar los datos', error: err.message });
            }
            res.json({ message: 'Inserción realizada correctamente en VENTA_PRODUCTOS_DETALLES.' });
        }
    );
});

app.put('/ventas-productos-detalles/actualizar', (req, res) => {
    const { COD_DETALLE, COD_VENTA, COD_PRODUCTO, CANTIDAD, PRECIO } = req.body;

    mysqlConnection.query(
        'CALL UPD_VENTA_PRODUCTOS_DETALLES(?, ?, ?, ?, ?)',
        [COD_DETALLE, COD_VENTA, COD_PRODUCTO, CANTIDAD, PRECIO],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar en VENTA_PRODUCTOS_DETALLES:', err.message);
                return res.status(500).json({ message: 'Error al actualizar los datos', error: err.message });
            }
            res.json({ message: 'Actualización realizada correctamente en VENTA_PRODUCTOS_DETALLES.' });
        }
    );
});

app.get('/ventas-productos-detalles/seleccionar', (req, res) => {
    const { COD_DETALLE, COD_VENTA } = req.query;

    mysqlConnection.query(
        'CALL SEL_VENTA_PRODUCTOS_DETALLES(?, ?)',
        [COD_DETALLE, COD_VENTA],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar en VENTA_PRODUCTOS_DETALLES:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar los datos', error: err.message });
            }
            res.json(results[0]);
        }
    );
});

// Endpoint para seleccionar clientes
app.get('/clientes/seleccionar', (req, res) => {
    const { COD_CLIENTE } = req.query;

    mysqlConnection.query(
        'CALL SEL_CLIENTE(?)',
        [COD_CLIENTE],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar cliente:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar cliente', error: err.message });
            }
            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron resultados.' });
            }
        }
    );
});

// Endpoint para insertar cliente
app.post('/clientes/insertar', (req, res) => {
    const { COD_RESERVACION, NOMBRE_CLIENTE, EDAD_CLIENTE, DIREC_CLIENTE, TELEFONO_CLIENTE, EMAIL_CLIENTE } = req.body;

    mysqlConnection.query(
        'CALL INS_CLIENTE(?, ?, ?, ?, ?, ?)',
        [COD_RESERVACION, NOMBRE_CLIENTE, EDAD_CLIENTE, DIREC_CLIENTE, TELEFONO_CLIENTE, EMAIL_CLIENTE],
        (err, results) => {
            if (err) {
                console.error('Error al insertar cliente:', err.message);
                return res.status(500).json({ message: 'Error al insertar cliente', error: err.message });
            }
            res.json({ message: 'Cliente insertado correctamente.' });
        }
    );
});

// Endpoint para actualizar cliente
app.put('/clientes/actualizar', (req, res) => {
    const { COD_CLIENTE, COD_RESERVACION, NOMBRE_CLIENTE, EDAD_CLIENTE, DIREC_CLIENTE, TELEFONO_CLIENTE, EMAIL_CLIENTE } = req.body;

    mysqlConnection.query(
        'CALL UPD_CLIENTE(?, ?, ?, ?, ?, ?, ?)',
        [COD_CLIENTE, COD_RESERVACION, NOMBRE_CLIENTE, EDAD_CLIENTE, DIREC_CLIENTE, TELEFONO_CLIENTE, EMAIL_CLIENTE],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar cliente:', err.message);
                return res.status(500).json({ message: 'Error al actualizar cliente', error: err.message });
            }
            res.json({ message: 'Cliente actualizado correctamente.' });
        }
    );
});

// POTS EMPLEADO
app.post('/empleados/insertar', (req, res) => {
    const {
        COD_EMPLEADO,
        PUESTO_EMPLEADO,
        NOMBRE_EMPLEADO,
        TELEFONO_EMPLEADO,
        EDAD_EMPLEADO,
        EMAIL_EMPLEADO
    } = req.body;

    mysqlConnection.query(
        'CALL INS_EMPLEADO(?, ?, ?, ?, ?, ?)',
        [
            COD_EMPLEADO,
            PUESTO_EMPLEADO,
            NOMBRE_EMPLEADO,
            TELEFONO_EMPLEADO,
            EDAD_EMPLEADO,
            EMAIL_EMPLEADO
        ],
        (err, results) => {
            if (err) {
                console.error('Error al insertar:', err.message);
                return res.status(500).json({ message: 'Error al insertar los datos', error: err.message });
            }
            res.json({ message: 'Empleado insertado correctamente.' });
        }
    );
});

// PUT EMPLEADO
app.put('/empleados/actualizar', (req, res) => {
    const {
        COD_EMPLEADO,
        PUESTO_EMPLEADO,
        NOMBRE_EMPLEADO,
        TELEFONO_EMPLEADO,
        EDAD_EMPLEADO,
        EMAIL_EMPLEADO
    } = req.body;

    mysqlConnection.query(
        'CALL UPD_EMPLEADO(?, ?, ?, ?, ?, ?)',
        [
            COD_EMPLEADO,
            PUESTO_EMPLEADO,
            NOMBRE_EMPLEADO,
            TELEFONO_EMPLEADO,
            EDAD_EMPLEADO,
            EMAIL_EMPLEADO
        ],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar:', err.message);
                return res.status(500).json({ message: 'Error al actualizar los datos', error: err.message });
            }
            res.json({ message: 'Empleado actualizado correctamente.' });
        }
    );
});

//API EMPLEADO
app.get('/empleados/seleccionar', (req, res) => {
    const { COD_EMPLEADO } = req.query;

    mysqlConnection.query(
        'CALL SEL_EMPLEADO(?)',
        [COD_EMPLEADO],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar los datos', error: err.message });
            }

            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron resultados.' });
            }
        }
    );
});

// Endpoint para insertar datos en la tabla RESERVACIONES
app.post('/reservaciones/insertar', (req, res) => {
    const {
        COD_CLIENTE,
        NOMBRE_CLIENTE,
        NUMERO_TELEFONO,
        EDAD_CLIENTE,
        EMAIL_CLIENTE,
        FEC_RESERVACION,
        ESTADO,
        NOMBRE_SERVICIO,
        DESCRIPCION_SERVICIO,
        PRECIO,
        DURACION
    } = req.body;

    mysqlConnection.query(
        'CALL INS_RESERVACIONES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [
            COD_CLIENTE,
            NOMBRE_CLIENTE,
            NUMERO_TELEFONO,
            EDAD_CLIENTE,
            EMAIL_CLIENTE,
            FEC_RESERVACION,
            ESTADO,
            NOMBRE_SERVICIO,
            DESCRIPCION_SERVICIO,
            PRECIO,
            DURACION
        ],
        (err, results) => {
            if (err) {
                console.error('Error al insertar:', err.message);
                return res.status(500).json({ message: 'Error al insertar los datos', error: err.message });
            }
            res.json({ message: 'Reservación insertada correctamente.' });
        }
    );
});

// Endpoint para actualizar datos en la tabla RESERVACIONES
app.put('/reservaciones/actualizar', (req, res) => {
    const {
        COD_RESERVACION,
        COD_CLIENTE,
        NOMBRE_CLIENTE,
        NUMERO_TELEFONO,
        EDAD_CLIENTE,
        EMAIL_CLIENTE,
        FEC_RESERVACION,
        ESTADO,
        NOMBRE_SERVICIO,
        DESCRIPCION_SERVICIO,
        PRECIO,
        DURACION
    } = req.body;

    mysqlConnection.query(
        'CALL UPD_RESERVACIONES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [
            COD_RESERVACION,
            COD_CLIENTE,
            NOMBRE_CLIENTE,
            NUMERO_TELEFONO,
            EDAD_CLIENTE,
            EMAIL_CLIENTE,
            FEC_RESERVACION,
            ESTADO,
            NOMBRE_SERVICIO,
            DESCRIPCION_SERVICIO,
            PRECIO,
            DURACION
        ],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar:', err.message);
                return res.status(500).json({ message: 'Error al actualizar los datos', error: err.message });
            }
            res.json({ message: 'Reservación actualizada correctamente.' });
        }
    );
});

// Endpoint para seleccionar datos en la tabla RESERVACIONES
app.get('/reservaciones/seleccionar', (req, res) => {
    const { COD_RESERVACION } = req.query;

    mysqlConnection.query(
        'CALL SEL_RESERVACIONES(?)',
        [COD_RESERVACION],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar los datos', error: err.message });
            }

            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron resultados.' });
            }
        }
    );
});

// Endpoint para insertar datos en la tabla HISTORIAL_RESERVACIONES
app.post('/historial/insertar', (req, res) => {
    const {
        COD_HISTORIAL,
        COD_RESERVACION,
        NOMBRE_CLIENTE,
        FEC_RESERVACION,
        ESTADO
    } = req.body;

    mysqlConnection.query(
        'CALL INS_HISTORIAL_RESERVACIONES(?, ?, ?, ?, ?)',
        [COD_HISTORIAL, COD_RESERVACION, NOMBRE_CLIENTE, FEC_RESERVACION, ESTADO],
        (err, results) => {
            if (err) {
                console.error('Error al insertar:', err.message);
                return res.status(500).json({ message: 'Error al insertar los datos', error: err.message });
            }
            res.json({ message: 'Historial de reservación insertado correctamente.' });
        }
    );
});

// Endpoint para actualizar datos en la tabla HISTORIAL_RESERVACIONES
app.put('/historial/actualizar', (req, res) => {
    const {
        COD_HISTORIAL,
        COD_RESERVACION,
        NOMBRE_CLIENTE,
        FEC_RESERVACION,
        ESTADO
    } = req.body;

    mysqlConnection.query(
        'CALL UPD_HISTORIAL_RESERVACIONES(?, ?, ?, ?, ?)',
        [COD_HISTORIAL, COD_RESERVACION, NOMBRE_CLIENTE, FEC_RESERVACION, ESTADO],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar:', err.message);
                return res.status(500).json({ message: 'Error al actualizar los datos', error: err.message });
            }
            res.json({ message: 'Historial de reservación actualizado correctamente.' });
        }
    );
});

// Endpoint para seleccionar datos en la tabla HISTORIAL_RESERVACIONES
app.get('/historial/seleccionar', (req, res) => {
    const { COD_HISTORIAL } = req.query;

    mysqlConnection.query(
        'CALL SEL_HISTORIAL_RESERVACIONES(?)',
        [COD_HISTORIAL],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar los datos', error: err.message });
            }

            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron resultados.' });
            }
        }
    );
});

// Endpoint para insertar datos usando el procedimiento almacenado INS_INVENTARIO
app.post('/inventario/insertar', (req, res) => {
    const { COD_DETALLE, NOMBRE_PRODUCTO, DESCRIPCION, PRECIO, EXISTENCIAS } = req.body;

    mysqlConnection.query(
        'CALL INS_INVENTARIO(?, ?, ?, ?, ?)',
        [COD_DETALLE, NOMBRE_PRODUCTO, DESCRIPCION, PRECIO, EXISTENCIAS],
        (err, results) => {
            if (err) {
                console.error('Error al insertar:', err.message);
                return res.status(500).json({ message: 'Error al insertar los datos', error: err.message });
            }
            res.json({ message: 'Inserción realizada correctamente.' });
        }
    );
});

// Endpoint para actualizar información en la base de datos usando UPD_INVENTARIO
app.put('/inventario/actualizar', (req, res) => {
    const { COD_PRODUCTO, COD_DETALLE, NOMBRE_PRODUCTO, DESCRIPCION, PRECIO, EXISTENCIAS } = req.body;

    mysqlConnection.query(
        'CALL UPD_INVENTARIO(?, ?, ?, ?, ?, ?)',
        [COD_PRODUCTO, COD_DETALLE, NOMBRE_PRODUCTO, DESCRIPCION, PRECIO, EXISTENCIAS],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar:', err.message);
                return res.status(500).json({ message: 'Error al actualizar los datos', error: err.message });
            }
            res.json({ message: 'Actualización realizada correctamente.' });
        }
    );
});

// Endpoint para seleccionar datos de un producto por COD_PRODUCTO usando SEL_INVENTARIO
app.get('/inventario/seleccionar', (req, res) => {
    const { COD_PRODUCTO } = req.query;

    mysqlConnection.query(
        'CALL SEL_INVENTARIO(?)',
        [COD_PRODUCTO],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar los datos:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar los datos', error: err.message });
            }

            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron resultados.' });
            }
        }
    );
});

// *Endpoint para insertar datos usando INS_PROVEEDORES*
app.post('/proveedores/insertar', (req, res) => {
    const { NOMBRE_PROVEEDOR, TELEFONO, DIRECCION, EMAIL } = req.body;

    mysqlConnection.query(
        'CALL INS_PROVEEDORES(?, ?, ?, ?)',
        [NOMBRE_PROVEEDOR, TELEFONO, DIRECCION, EMAIL],
        (err, results) => {
            if (err) {
                console.error('Error al insertar:', err.message);
                return res.status(500).json({ message: 'Error al insertar los datos', error: err.message });
            }
            res.json({ message: 'Inserción realizada correctamente.' });
        }
    );
});

// *Endpoint para actualizar datos usando UPD_PROVEEDORES*
app.put('/proveedores/actualizar', (req, res) => {
    const { COD_PROVEEDOR, NOMBRE_PROVEEDOR, TELEFONO, DIRECCION, EMAIL } = req.body;

    mysqlConnection.query(
        'CALL UPD_PROVEEDORES(?, ?, ?, ?, ?)',
        [COD_PROVEEDOR, NOMBRE_PROVEEDOR, TELEFONO, DIRECCION, EMAIL],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar:', err.message);
                return res.status(500).json({ message: 'Error al actualizar los datos', error: err.message });
            }
            res.json({ message: 'Actualización realizada correctamente.' });
        }
    );
});

// *Endpoint para seleccionar datos usando SEL_PROVEEDORES*
app.get('/proveedores/seleccionar', (req, res) => {
    const { COD_PROVEEDOR } = req.query;

    mysqlConnection.query(
        'CALL SEL_PROVEEDORES(?)',
        [COD_PROVEEDOR || null],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar los datos:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar los datos', error: err.message });
            }

            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron resultados.' });
            }
        }
    );
});

app.post('/compra/insertar', (req, res) => {
    const { COD_PROVEEDOR, FEC_COMPRA, TOTAL } = req.body;

    mysqlConnection.query(
        'CALL INS_COMPRA_PRODUCTOS(?, ?, ?)',
        [COD_PROVEEDOR, FEC_COMPRA, TOTAL],
        (err, results) => {
            if (err) {
                console.error('Error al insertar compra:', err.message);
                return res.status(500).json({ message: 'Error al insertar la compra', error: err.message });
            }
            res.json({ message: 'Compra insertada correctamente.' });
        }
    );
});

app.put('/compra/actualizar', (req, res) => {
    const { COD_COMPRA, COD_PROVEEDOR, FEC_COMPRA, TOTAL } = req.body;

    mysqlConnection.query(
        'CALL UPD_COMPRA_PRODUCTOS(?, ?, ?, ?)',
        [COD_COMPRA, COD_PROVEEDOR, FEC_COMPRA, TOTAL],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar compra:', err.message);
                return res.status(500).json({ message: 'Error al actualizar la compra', error: err.message });
            }
            res.json({ message: 'Compra actualizada correctamente.' });
        }
    );
});

app.get('/compra/seleccionar', (req, res) => {
    const { COD_COMPRA, COD_PROVEEDOR } = req.query;

    mysqlConnection.query(
        'CALL SEL_COMPRA_PRODUCTOS(?, ?)',
        [COD_COMPRA || null, COD_PROVEEDOR || null],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar compra:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar la compra', error: err.message });
            }

            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron compras.' });
            }
        }
    );
});

app.post('/compra-detalles/insertar', (req, res) => {
    const { COD_COMPRA, CANTIDAD, PRECIO } = req.body;

    mysqlConnection.query(
        'CALL INS_COMPRA_PRODUCTOS_DETALLES(?, ?, ?)',
        [COD_COMPRA, CANTIDAD, PRECIO],
        (err, results) => {
            if (err) {
                console.error('Error al insertar detalle:', err.message);
                return res.status(500).json({ message: 'Error al insertar el detalle', error: err.message });
            }
            res.json({ message: 'Detalle de compra insertado correctamente.' });
        }
    );
});

app.put('/compra-detalles/actualizar', (req, res) => {
    const { COD_DETALLE, COD_COMPRA, CANTIDAD, PRECIO } = req.body;

    mysqlConnection.query(
        'CALL UPD_COMPRA_PRODUCTOS_DETALLES(?, ?, ?, ?)',
        [COD_DETALLE, COD_COMPRA, CANTIDAD, PRECIO],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar detalle:', err.message);
                return res.status(500).json({ message: 'Error al actualizar el detalle', error: err.message });
            }
            res.json({ message: 'Detalle de compra actualizado correctamente.' });
        }
    );
});

app.get('/compra-detalles/seleccionar', (req, res) => {
    const { COD_DETALLE, COD_COMPRA } = req.query;

    mysqlConnection.query(
        'CALL SEL_COMPRA_PRODUCTOS_DETALLES(?, ?)',
        [COD_DETALLE || null, COD_COMPRA || null],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar detalles:', err.message);
                return res.status(500).json({ message: 'Error al seleccionar los detalles', error: err.message });
            }

            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron detalles.' });
            }
        }
    );
});

// Ruta para insertar un nuevo reporte de compra
app.post('/reportes-compras/insertar', (req, res) => {
    const { COD_REPORTE_COM, COD_COMPRA, FEC_COMPRA, TOTAL } = req.body;

    mysqlConnection.query(
        'CALL INS_REPORTES_COMPRAS(?, ?, ?, ?)',
        [COD_REPORTE_COM, COD_COMPRA, FEC_COMPRA, TOTAL],
        (err, results) => {
            if (err) {
                console.error('Error al insertar reporte de compra:', err.message);
                return res.status(500).json({ message: 'Error al insertar el reporte', error: err.message });
            }
            res.json({ message: 'Reporte de compra insertado correctamente.' });
        }
    );
});

// Ruta para actualizar un reporte de compra
app.put('/reportes-compras/actualizar', (req, res) => {
    const { COD_REPORTE_COM, COD_COMPRA, FEC_COMPRA, TOTAL } = req.body;

    mysqlConnection.query(
        'CALL UPD_REPORTES_COMPRAS(?, ?, ?, ?)',
        [COD_REPORTE_COM, COD_COMPRA, FEC_COMPRA, TOTAL],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar reporte de compra:', err.message);
                return res.status(500).json({ message: 'Error al actualizar el reporte', error: err.message });
            }
            res.json({ message: 'Reporte de compra actualizado correctamente.' });
        }
    );
});

// Ruta para seleccionar reportes de compra
app.get('/reportes-compras/seleccionar', (req, res) => {
    const { COD_REPORTE_COM } = req.query;

    mysqlConnection.query(
        'CALL SEL_REPORTES_COMPRAS(?)',
        [COD_REPORTE_COM],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar reportes de compra:', err.message);
                return res.status(500).json({ message: 'Error al obtener los reportes', error: err.message });
            }
            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron reportes de compra.' });
            }
        }
    );
});

app.post('/reportes-ventas/insertar', (req, res) => {
    const { COD_REPORTE_VEN, COD_VENTA, FEC_REPORTE, TOTAL } = req.body;

    mysqlConnection.query(
        'CALL INS_REPORTES_VENTAS(?, ?, ?, ?)',
        [COD_REPORTE_VEN, COD_VENTA, FEC_REPORTE, TOTAL],
        (err, results) => {
            if (err) {
                console.error('Error al insertar reporte de venta:', err.message);
                return res.status(500).json({ message: 'Error al insertar el reporte', error: err.message });
            }
            res.json({ message: 'Reporte de venta insertado correctamente.' });
        }
    );
});

app.put('/reportes-ventas/actualizar', (req, res) => {
    const { COD_REPORTE_VEN, COD_VENTA, FEC_REPORTE, TOTAL } = req.body;

    mysqlConnection.query(
        'CALL UPD_REPORTES_VENTAS(?, ?, ?, ?)',
        [COD_REPORTE_VEN, COD_VENTA, FEC_REPORTE, TOTAL],
        (err, results) => {
            if (err) {
                console.error('Error al actualizar reporte de venta:', err.message);
                return res.status(500).json({ message: 'Error al actualizar el reporte', error: err.message });
            }
            res.json({ message: 'Reporte de venta actualizado correctamente.' });
        }
    );
});

app.get('/reportes-ventas/seleccionar', (req, res) => {
    const { COD_REPORTE_VEN } = req.query;

    mysqlConnection.query(
        'CALL SEL_REPORTES_VENTAS(?)',
        [COD_REPORTE_VEN],
        (err, results) => {
            if (err) {
                console.error('Error al seleccionar reportes de venta:', err.message);
                return res.status(500).json({ message: 'Error al obtener los reportes', error: err.message });
            }
            if (results && results[0].length > 0) {
                res.json(results[0]);
            } else {
                res.status(404).json({ message: 'No se encontraron reportes de venta.' });
            }
        }
    );
});


// Iniciar el servidor en el puerto 3000
app.listen(3000, () => console.log('Servidor corriendo en el puerto 3000'));
