<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>III Jornada Científica 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
    /* Estilos modernos para la sección de registro y modal */
    .registration-section { padding: 4rem 0; background-color: #f9f9fb; }
    .registration-section .registration-form { max-width: 50rem; margin: 0 auto; background: #ffffff; padding: 2.5rem 2.5rem 2rem 2.5rem; border-radius: 1.5rem; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .registration-section .form-group { margin-bottom: 1.5rem; }
    .registration-section .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
    }
    .registration-section .form-row .form-group {
        flex: 1 1 45%;
        min-width: 220px;
        margin-bottom: 1.5rem;
    }
    @media (max-width: 768px) {
        .registration-section .form-row {
            flex-direction: column;
            gap: 0;
        }
    }
    .registration-section label { display: block; color: #374151; font-weight: 600; margin-bottom: .5rem; }
    .registration-section input, .registration-section select { width: 100%; padding: .75rem 1rem; border: 1px solid #d1d5db; border-radius: .75rem; transition: border-color .3s, box-shadow .3s; }
    .registration-section input:focus, .registration-section select:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.25); outline: none; }
    .registration-section button[type="submit"] { width: 100%; background-color: #6366f1; color: #fff; padding: 1rem; font-size: 1rem; font-weight: 600; border: none; border-radius: .75rem; transition: background-color .3s, transform .2s; }
    .registration-section button[type="submit"]:hover { background-color: #4f46e5; transform: translateY(-2px); }
    .modal-content { border-radius: 1rem !important; overflow: hidden; }
    .modal-header, .modal-footer { border: none !important; }
    .modal-body { padding: 2rem !important; }
    #carnetImage { border-radius: .5rem; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-width:100%; }
    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav container">
            <a href="#" class="logo">
                <img src="{{ asset('images/icons/logo.png') }}" alt="Logo" width="50">
            </a>
                <ul class="nav-links">
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#acerca">Acerca</a></li>
                <li><a href="#ponentes">Ponentes</a></li>
                <li><a href="#programa">Programa</a></li>
                <li><a href="/admin">iniciar sesion</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="inicio" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>III Jornada Científica 2025</h1>
                <p class="subtitle">Un espacio para el intercambio de conocimientos y avances en la investigación científica</p>
                <a href="#registro" class="cta-button">inscribete Ahora</a>
                
                <div class="event-info">
                    <div class="info-card">
                        <h3>Fecha</h3>
                        <p>01 Agosto 2025</p>
                    </div>
                    <div class="info-card">
                        <h3>Modalidad</h3>
                        <p>Presencial</p>
                    </div>
                    <div class="info-card">
                        <h3>Participantes</h3>
                        <p>500+ Investigadores</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="acerca" class="about">
        <div class="container">
            <div class="about-grid">
                <div class="about-content">
                    <h2>Intercambio de Conocimientos</h2>
                    <p>La III Jornada Científica 2025 representa un espacio privilegiado para el encuentro de investigadores, académicos y profesionales comprometidos con el avance de la ciencia y la tecnología.</p>
                    <p>Durante dos días intensivos, facilitaremos el intercambio de ideas innovadoras, metodologías de vanguardia y resultados de investigación que están transformando nuestro entendimiento del mundo.</p>
                    <p>Únete a nosotros en esta celebración del conocimiento científico y contribuye al diálogo que está dando forma al futuro de la investigación.</p>
                </div>
                <div class="about-image">
                    <img src="{{ asset('images/evento.jpeg') }}" alt="Imagen del Evento Científico">
                </div>
            </div>
        </div>
    </section>

    <!-- Speakers Section -->
    <section id="ponentes" class="speakers">
        <div class="container">
            <h2>Ponentes Destacados</h2>
            <div class="speakers-grid">
                <div class="speaker-card">
                    <div class="speaker-image">Foto Dr.Paiva</div>
                    <div class="speaker-info">
                        <h3>Dr. Paiva Paiva</h3>
                        <p>Investigadora Principal<br>Instituto de Biotecnología</p>
                    </div>
                </div>
                <div class="speaker-card">
                    <div class="speaker-image">Foto Dra. Zulay García</div>
                    <div class="speaker-info">
                        <h3>Dra. Zulay García</h3>
                        <p>Investigadora Principal<br>Instituto de Biotecnología</p>
                    </div>
                </div>
                <div class="speaker-card">
                    <div class="speaker-image">Foto Dr. William Jhelis</div>
                    <div class="speaker-info">
                        <h3>Dr. William Jhelis</h3>
                        <p>Investigador Principal<br>Instituto de Biotecnología</p>
                    </div>
                </div>
                <div class="speaker-card">
                    <div class="speaker-image">Foto Dr. Juan Galindez</div>
                    <div class="speaker-info">
                        <h3>Dr. Juan Galindez</h3>
                        <p>Investigador Principal<br>Instituto de Biotecnología</p>
                    </div>
                </div>
                <div class="speaker-card">
                    <div class="speaker-image">Foto Dr. José Luis Alarcón</div>
                    <div class="speaker-info">
                        <h3>Dr. José Luis Alarcón</h3>
                        <p>Investigador Principal<br>Instituto de Biotecnología</p>
                    </div>
                </div>
                <div class="speaker-card">
                    <div class="speaker-image">Foto Dr. Carmelo García</div>
                    <div class="speaker-info">
                        <h3>Dr. Carmelo García</h3>
                        <p>Investigador Principal<br>Instituto de Biotecnología</p>
                    </div>
                </div>
                <div class="speaker-card">
                    <div class="speaker-image">Foto Dra. Cruz Marchan</div>
                    <div class="speaker-info">
                        <h3>Dra. Cruz Marchan</h3>
                        <p>Investigadora Principal<br>Instituto de Biotecnología</p>
                    </div>
                </div>
                <div class="speaker-card">
                    <div class="speaker-image">Foto Dr. Vinicio Rondón</div>
                    <div class="speaker-info">
                        <h3>Dr. Vinicio Rondón</h3>
                        <p>Investigador Principal<br>Instituto de Biotecnología</p>
                    </div>
                </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section id="programa" class="schedule">
        <div class="container">
            <h2>Programa del Evento</h2>
            <div class="schedule-timeline">
                <div class="timeline-item">
                    <div class="timeline-time">09:00</div>
                    <div class="timeline-content">
                        <h3>Inauguración y Bienvenida</h3>
                        <p>Palabras de apertura y presentación de objetivos</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-time">10:00</div>
                    <div class="timeline-content">
                        <h3>Conferencia Magistral</h3>
                        <p>"Avances en Investigación Científica: Perspectivas Futuras"</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-time">11:30</div>
                    <div class="timeline-content">
                        <h3>Mesa Redonda</h3>
                        <p>Intercambio de experiencias en metodologías de investigación</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-time">14:00</div>
                    <div class="timeline-content">
                        <h3>Presentación de Proyectos</h3>
                        <p>Exposición de investigaciones en desarrollo</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Section -->
    <section id="registro" class="registration-section">
        <div class="container">
            <h2 class="text-center">Registro de Participantes</h2>
            <div class="registration-form d-flex justify-content-center">
                <div style="width:100%;">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                            @if(session('carnet_url'))
                                <div id="carnetData" data-url="{{ session('carnet_url') }}" data-cedula="{{ session('cedula') }}">
                                    <p>Se ha generado tu carnet exitosamente.</p>
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('registro.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre Completo *</label>
                                <input type="text" id="nombre" name="nombre" required class="form-control" value="{{ old('nombre') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="cedula">Cédula de Identidad *</label>
                                <input type="text" id="cedula" name="cedula" required class="form-control" value="{{ old('cedula') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group mb-3">
                                <label for="email">Correo Electrónico *</label>
                                <input type="email" id="email" name="email" required class="form-control" value="{{ old('email') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="telefono">Teléfono *</label>
                                <input type="tel" id="telefono" name="telefono" required class="form-control" value="{{ old('telefono') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group mb-3">
                                <label for="profesion">Profesión *</label>
                                <select id="profesion" name="profesion" class="form-control" required>
                                    <option value="" {{ old('profesion') === null ? 'selected' : '' }}>Seleccione su profesión</option>
                                    <option value="estudiante_pregrado" {{ old('profesion') == 'estudiante_pregrado' ? 'selected' : '' }}>Estudiante Pregrado</option>
                                    <option value="medico_cirujano" {{ old('profesion') == 'medico_cirujano' ? 'selected' : '' }}>Médico Cirujano</option>
                                    <option value="estudiante_postgrado" {{ old('profesion') == 'estudiante_postgrado' ? 'selected' : '' }}>Estudiante Postgrado</option>
                                    <option value="especialista" {{ old('profesion') == 'especialista' ? 'selected' : '' }}>Especialista</option>
                                    <option value="fisioterapia" {{ old('profesion') == 'fisioterapia' ? 'selected' : '' }}>Fisioterapia</option>
                                    <option value="enfermeria" {{ old('profesion') == 'enfermeria' ? 'selected' : '' }}>Enfermería</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="foto">Foto (opcional, para el carnet)</label>
                                <input type="file" id="foto" name="foto" accept="image/*" class="form-control">
                                <small class="form-text text-muted">Tamaño recomendado: 300x300px. Formatos: JPG, PNG.</small>
                            </div>
                            <div class="col-12 text-center">
                                        <div class="g-recaptcha mb-3" data-sitekey="6LcBI1krAAAAACDh4vWxfnf7jNZOPdhGQLSi-94Y"></div>
                            </div>
                        </div>
                        <div class="form-actions mt-4">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Modal para mostrar el carnet -->
    <div class="modal fade" id="carnetModal" tabindex="-1" aria-labelledby="carnetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carnetModalLabel">Tu Carnet de Participación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="carnetContainer">
                        <img id="carnetImage" src="" alt="Carnet de Participación" class="img-fluid mb-3">
                        <p class="text-muted">Guarda este carnet, deberás presentarlo el día del evento.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a id="downloadCarnet" href="#" class="btn btn-primary" download="carnet-participacion.png">
                        <i class="fas fa-download me-1"></i> Descargar Carnet
                    </a>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Modal con Carrusel -->
     <div class="modal fade" id="carouselModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="carouselModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="welcomeCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#welcomeCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#welcomeCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#welcomeCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/components/modal2.jpeg" class="d-block w-100" alt="Imagen 1">
                            </div>
                            <div class="carousel-item">
                                <img src="images/components/modal1.jpeg" class="d-block w-100" alt="Imagen 2">
                            </div>
                            <div class="carousel-item">
                                <img src="images/components/modal3.jpeg" class="d-block w-100" alt="Imagen 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    @if(session('registro_data'))
        <div id="registroData" data-registro='@json(session('registro_data'))' style="display:none;"></div>
        <canvas id="carnetCanvas" width="800" height="500" style="display:none;"></canvas>
    @endif

    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Mostrar el modal del carrusel automáticamente al cargar la página (puedes cambiar esto a un botón si lo prefieres)
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('carouselModal')) {
            var carouselModal = new bootstrap.Modal(document.getElementById('carouselModal'));
            carouselModal.show();
        }
    });
        // Funciones auxiliares para dibujar rectángulos redondeados
        function drawRoundedRect(ctx, x, y, width, height, radius) {
            radius = Math.min(radius, width/2, height/2);
            ctx.beginPath();
            drawRoundedPath(ctx, x, y, width, height, radius);
            ctx.closePath();
        }
        
        function drawRoundedPath(ctx, x, y, width, height, radius) {
            ctx.moveTo(x + radius, y);
            ctx.arcTo(x + width, y, x + width, y + height, radius);
            ctx.arcTo(x + width, y + height, x, y + height, radius);
            ctx.arcTo(x, y + height, x, y, radius);
            ctx.arcTo(x, y, x + width, y, radius);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const registroEl = document.getElementById('registroData');
            if (!registroEl) return;
            const data = JSON.parse(registroEl.dataset.registro);
            const canvas = document.getElementById('carnetCanvas');
            const ctx = canvas.getContext('2d');
                // Fondo blanco limpio
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Borde sutil
            ctx.strokeStyle = '#e5e7eb';
            ctx.lineWidth = 1;
            ctx.strokeRect(0, 0, canvas.width, canvas.height);
            
            // Encabezado con gradiente moderno
            const headerGradient = ctx.createLinearGradient(0, 0, canvas.width, 0);
            headerGradient.addColorStop(0, '#3b82f6');  // azul
            headerGradient.addColorStop(1, '#8b5cf6');  // púrpura
            
            ctx.fillStyle = headerGradient;
            ctx.fillRect(0, 0, canvas.width, 100);
            
            // Logo o título del evento
            ctx.font = '600 24px "Segoe UI", system-ui, -apple-system, sans-serif';
            ctx.fillStyle = '#ffffff';
            ctx.textAlign = 'center';
            ctx.fillText('III JORNADA CIENTÍFICA 2025', canvas.width / 2, 60);
            
            // Subtítulo
            ctx.font = '400 14px "Segoe UI", system-ui, -apple-system, sans-serif';
            ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
            ctx.fillText('Carnet de Identificación', canvas.width / 2, 85);
            
            // Fondo de la sección de contenido
            ctx.fillStyle = '#f9fafb';
            ctx.fillRect(40, 120, canvas.width - 80, canvas.height - 160);
            
            // Sombra sutil para la foto
            ctx.shadowColor = 'rgba(0, 0, 0, 0.1)';
            ctx.shadowBlur = 10;
            ctx.shadowOffsetX = 2;
            ctx.shadowOffsetY = 2;
            
            // Sección de foto (lado izquierdo)
            const photoX = 60;
            const photoY = 150;
            const photoWidth = 240;
            const photoHeight = 300;
            
            // Fondo de la foto con sombra
            ctx.shadowColor = 'rgba(0, 0, 0, 0.1)';
            ctx.shadowBlur = 10;
            ctx.shadowOffsetX = 2;
            ctx.shadowOffsetY = 2;
            
            // Marco de la foto
            ctx.fillStyle = '#ffffff';
            ctx.beginPath();
            ctx.roundRect(photoX, photoY, photoWidth, photoHeight, 8);
            ctx.fill();
            
            // Borde sutil
            ctx.strokeStyle = '#e5e7eb';
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.roundRect(photoX, photoY, photoWidth, photoHeight, 8);
            ctx.stroke();
            
            // Contenedor de la imagen
            const imagePadding = 20;
            const imageX = photoX + imagePadding;
            const imageY = photoY + imagePadding;
            const imageWidth = photoWidth - (imagePadding * 2);
            const imageHeight = photoHeight - (imagePadding * 2);
            
            if (data.foto) {
                const img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = function() {
                    // Recortar la imagen en forma redondeada
                    ctx.save();
                    ctx.beginPath();
                    ctx.roundRect(imageX, imageY, imageWidth, imageHeight, 4);
                    ctx.clip();
                    
                    // Asegurar que la imagen cubra el área sin distorsión
                    const imgRatio = img.width / img.height;
                    const containerRatio = imageWidth / imageHeight;
                    
                    let drawWidth, drawHeight, offsetX = 0, offsetY = 0;
                    
                    if (imgRatio > containerRatio) {
                        // La imagen es más ancha que el contenedor
                        drawHeight = imageHeight;
                        drawWidth = drawHeight * imgRatio;
                        offsetX = (imageWidth - drawWidth) / 2;
                    } else {
                        // La imagen es más alta que el contenedor
                        drawWidth = imageWidth;
                        drawHeight = drawWidth / imgRatio;
                        offsetY = (imageHeight - drawHeight) / 2;
                    }
                    
                    ctx.drawImage(img, 
                        imageX + offsetX, 
                        imageY + offsetY, 
                        drawWidth, 
                        drawHeight
                    );
                    
                    ctx.restore();
                    drawTextAndShow();
                };
                img.onerror = function() {
                    // En caso de error al cargar la imagen
                    showPlaceholderPhoto();
                };
                img.src = data.foto;
            } else {
                showPlaceholderPhoto();
            }
            
            function showPlaceholderPhoto() {
                // Fondo para la foto faltante
                ctx.fillStyle = '#f3f4f6';
                ctx.beginPath();
                ctx.roundRect(imageX, imageY, imageWidth, imageHeight, 4);
                ctx.fill();
                
                // Icono de cámara
                ctx.fillStyle = '#9ca3af';
                ctx.font = '48px "Segoe UI", system-ui, sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText('📷', photoX + (photoWidth / 2), photoY + (photoHeight / 2) - 10);
                
                // Texto
                ctx.font = '14px "Segoe UI", system-ui, sans-serif';
                ctx.fillStyle = '#6b7280';
                ctx.fillText('FOTO', photoX + (photoWidth / 2), photoY + (photoHeight / 2) + 30);
                
                drawTextAndShow();
            }
            function drawTextAndShow() {
                // Restablecer sombras
                ctx.shadowBlur = 0;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 0;
                
                // Posición inicial para el contenido
                const startX = 340;
                let yPos = 180;
                const lineHeight = 32;
                
                // Título de la sección
                ctx.fillStyle = '#3b82f6'; // Azul moderno
                ctx.font = '600 18px "Segoe UI", system-ui, sans-serif';
                ctx.textAlign = 'left';
                ctx.textBaseline = 'top';
                ctx.fillText('INFORMACIÓN DEL PARTICIPANTE', startX, yPos);
                
                // Línea decorativa
                const lineY = yPos + 28;
                const lineWidth = 300;
                
                // Gradiente para la línea
                const lineGradient = ctx.createLinearGradient(startX, 0, startX + lineWidth, 0);
                lineGradient.addColorStop(0, '#3b82f6');
                lineGradient.addColorStop(1, '#8b5cf6');
                
                ctx.strokeStyle = lineGradient;
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.moveTo(startX, lineY);
                ctx.lineTo(startX + lineWidth, lineY);
                ctx.stroke();
                
                // Función para dibujar un campo de información
                const drawField = (label, value, y, isHighlighted = false) => {
                    // Etiqueta
                    ctx.fillStyle = '#4b5563'; // Gris oscuro
                    ctx.font = '500 14px "Segoe UI", system-ui, sans-serif';
                    ctx.fillText(label, startX, y);
                    
                    // Valor
                    const valueX = startX + 140;
                    if (isHighlighted) {
                        // Fondo resaltado para el nombre
                        const textWidth = ctx.measureText(value).width + 20;
                        ctx.fillStyle = '#eef2ff'; // Fondo azul muy claro
                        ctx.beginPath();
                        ctx.roundRect(valueX - 10, y - 15, textWidth, 24, 12);
                        ctx.fill();
                        
                        // Texto del nombre
                        ctx.fillStyle = '#3b82f6'; // Azul moderno
                        ctx.font = '600 15px "Segoe UI", system-ui, sans-serif';
                    } else {
                        ctx.fillStyle = '#1f2937'; // Casi negro
                        ctx.font = '14px "Segoe UI", system-ui, sans-serif';
                    }
                    
                    // Ajustar texto largo
                    const maxWidth = 300;
                    let text = value;
                    let metrics = ctx.measureText(text);
                    
                    if (metrics.width > maxWidth) {
                        // Acortar texto con puntos suspensivos
                        while (metrics.width > maxWidth && text.length > 0) {
                            text = text.substring(0, text.length - 1);
                            metrics = ctx.measureText(text + '...');
                        }
                        text += '...';
                    }
                    
                    ctx.fillText(text, valueX, y);
                    return y + lineHeight;
                };
                
                // Espaciado después del título
                yPos += 50;
                
                // Datos del participante
                yPos = drawField('NOMBRE:', data.nombre.toUpperCase(), yPos, true);
                yPos = drawField('CÉDULA:', data.cedula, yPos);
                yPos = drawField('CÓDIGO:', data.codigo_inscripcion, yPos);
                yPos = drawField('FECHA:', data.fecha, yPos);
                
                // Pie de página
                ctx.fillStyle = '#6b7280'; // Gris medio
                ctx.font = 'italic 12px "Segoe UI", system-ui, sans-serif';
                ctx.textAlign = 'center';
                ctx.fillText('Este carnet es personal e intransferible', canvas.width / 2, 500);
                
                // Mostrar el contenedor del carnet
                document.getElementById('carnetContainer').style.display = 'block';
                
                // Configurar el botón de descarga
                const downloadBtn = document.getElementById('downloadCarnet');
                if (downloadBtn) {
                    // Usar addEventListener en lugar de onclick directo
                    downloadBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const link = document.createElement('a');
                        link.download = 'carnet-' + data.cedula + '.png';
                        link.href = canvas.toDataURL('image/png');
                        link.click();
                    });
                    
                    // Añadir clase al botón para estilos
                    downloadBtn.classList.add('btn', 'btn-primary');
                }
                
                // Mostrar la imagen generada en el modal
                const dataUrl = canvas.toDataURL('image/png');
                const carnetImage = document.getElementById('carnetImage');
                const downloadLink = document.getElementById('downloadCarnet');
                
                carnetImage.src = dataUrl;
                carnetImage.alt = `Carnet de ${data.nombre}`;
                downloadLink.href = dataUrl;
                downloadLink.download = `carnet-${data.cedula}.png`;
                
                // Mostrar el modal
                const modal = new bootstrap.Modal(document.getElementById('carnetModal'));
                modal.show();
            }
        });
    </script>