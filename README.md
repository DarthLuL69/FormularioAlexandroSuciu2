# Ventajas y Desventajas de Importar Librerías Localmente vs. CDN

## Ventajas de Importar Librerías Localmente
1. **Disponibilidad Offline**: Las librerías están disponibles incluso sin conexión a internet.
2. **Control de Versiones**: Puedes asegurar que siempre se usa una versión específica de la librería.
3. **Seguridad**: Menor riesgo de ataques de tipo Man-in-the-Middle (MITM) ya que no dependes de servidores externos.

## Desventajas de Importar Librerías Localmente
1. **Tamaño del Proyecto**: Aumenta el tamaño del proyecto, lo que puede hacer que las descargas sean más lentas.
2. **Actualizaciones Manuales**: Necesitas actualizar manualmente las librerías cuando hay nuevas versiones.

## Ventajas de Usar CDN
1. **Rendimiento**: Los CDNs están optimizados para la entrega rápida de contenido y pueden reducir los tiempos de carga.
2. **Cache Compartida**: Los navegadores pueden cachear librerías comunes, reduciendo el tiempo de carga para los usuarios.
3. **Actualizaciones Automáticas**: Las librerías se actualizan automáticamente a la última versión disponible.

## Desventajas de Usar CDN
1. **Dependencia Externa**: Dependencia de servidores externos que pueden estar caídos o ser lentos.
2. **Seguridad**: Mayor riesgo de ataques de tipo Man-in-the-Middle (MITM) y otros problemas de seguridad.
3. **Disponibilidad**: Si el CDN está caído, tu aplicación puede no funcionar correctamente.

## Uso de SweetAlert2 para las Alertas del Proyecto

SweetAlert2 se ha utilizado en este proyecto para proporcionar una experiencia de usuario más profesional y atractiva en la gestión de alertas. Las razones para elegir SweetAlert2 incluyen:

1. **Interfaz de Usuario Atractiva**: SweetAlert2 ofrece una interfaz de usuario moderna y atractiva que mejora la apariencia general de las alertas en comparación con las alertas nativas del navegador.
2. **Personalización**: Permite una amplia personalización de las alertas, incluyendo colores, iconos, botones y más, lo que permite adaptarlas al estilo del proyecto.
3. **Facilidad de Uso**: SweetAlert2 es fácil de integrar y usar en proyectos web, con una API sencilla y bien documentada.
4. **Funcionalidades Avanzadas**: Ofrece funcionalidades avanzadas como confirmaciones, temporizadores, y más, que no están disponibles en las alertas nativas del navegador.
5. **Compatibilidad**: Es compatible con todos los navegadores modernos, asegurando una experiencia consistente para todos los usuarios.

En resumen, SweetAlert2 se ha elegido para este proyecto debido a su capacidad para mejorar significativamente la experiencia del usuario y proporcionar alertas más atractivas y funcionales.


