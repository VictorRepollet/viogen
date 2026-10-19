# 🛡️ VioGen

<div align="center">

### Una propuesta para organizar información relacionada con casos de violencia de género

Proyecto académico en desarrollo, construido con **PHP**, **HTML** y **JSON**.

<br>

![Estado: en desarrollo](https://img.shields.io/badge/estado-en%20desarrollo-8b5cf6?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-prototipo-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Idioma: español](https://img.shields.io/badge/idioma-español-f97316?style=for-the-badge)

</div>

---

## ✨ Sobre el proyecto

**VioGen** es un prototipo académico orientado a la gestión de información de víctimas, agresores e incidencias. La idea es reunir estos elementos en una aplicación sencilla y ampliable.

> **Importante:** este repositorio no es un sistema oficial ni una herramienta de atención de emergencias. Está en una fase inicial y no debe utilizarse para almacenar información personal o datos reales.

## 🧭 Estructura del proyecto

```text
viogen/
├── index.php                 # Entrada de la aplicación
├── html/
│   ├── index.html            # Portada del proyecto
│   ├── victima.html          # Ficha de víctima e indicadores
│   ├── agresor.html          # Ficha de agresor e indicadores
│   ├── incidencia.html       # Registro de incidencia e indicadores
│   └── informe-final.html    # Espacio previsto para el informe
├── formulario-victima.php    # Ruta PHP de la ficha de víctima
├── formulario-agresor.php    # Ruta PHP de la ficha de agresor
├── formulario-incidencia.php # Ruta PHP del registro de incidencia
├── assets/
│   └── acompanamiento.svg    # Ilustración de la portada
├── css/
│   ├── index.css             # Estilos de la portada
│   └── forms.css             # Estilos compartidos de los formularios
├── js/
│   ├── index.js              # Efectos visuales de la portada
│   └── forms.js              # Recuento de indicadores respondidos
└── datos/
    ├── victimas.json         # Almacenamiento previsto
    ├── agresor.json          # Almacenamiento previsto
    └── incidencias.json      # Almacenamiento previsto
```

### Estado actual

- ✅ Portada y formularios de víctima, agresor e incidencia.
- ✅ Diez indicadores de contexto distribuidos entre las tres fichas; las respuestas son “Sí”, “No” o “No consta”.
- 🚧 El guardado, la evaluación del riesgo y la generación del informe aún no están implementados.

Los formularios son una maqueta académica: sus botones de guardado están deshabilitados y no almacenan ni envían información. No introduzcas datos personales reales. Los indicadores no representan una valoración profesional ni sustituyen protocolos oficiales.

## 🚀 Cómo ejecutar

Necesitas tener **PHP** instalado. Desde la raíz del repositorio, inicia el servidor integrado:

```bash
php -S localhost:8000 -t viogen
```

Abre [http://localhost:8000](http://localhost:8000) en el navegador para ver la pantalla de bienvenida.

## 🧰 Tecnologías

| Tecnología | Uso previsto |
|---|---|
| PHP | Entrada y procesamiento del servidor |
| HTML | Estructura de las pantallas |
| CSS | Presentación visual |
| JSON | Persistencia local prevista para los datos |

## 👥 Equipo

Proyecto realizado por **Felipe Almeida**, **Victor Repollet** y **Victor Gordillo**.

---

<div align="center">

Hecho con propósito académico · **VioGen**

</div>
