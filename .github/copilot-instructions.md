# Instrucciones de optimización de tokens para GitHub Copilot

## Reglas de eficiencia y ahorro de tokens
1. **Respuestas ultra concisas**: No expliques conceptos obvios ni resumas el código en texto si ya se usó una herramienta de edición.
2. **Minimizar lecturas de archivos**:
   - Lee rangos específicos de líneas en lugar de archivos completos cuando solo se necesite una sección.
   - Evita búsquedas repetitivas y llamadas redundantes a herramientas.
3. **No imprimir bloques de código grandes**: Si el código ya se aplicó a un archivo, menciona solo el archivo modificado y la acción realizada.
4. **Pruebas focalizadas**: Ejecuta pruebas individuales en lugar de toda la suite en tareas pequeñas (`php artisan test pruebas/NombreTest.php --compact`).
5. **Contexto de archivos**: Trabaja únicamente sobre los archivos relevantes de la petición sin inspeccionar directorios ajenos al problema.
