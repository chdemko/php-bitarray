set terminal pngcairo  transparent enhanced font "arial,10" fontscale 1.0 size 500, 350
set key inside left top vertical Right noreverse enhanced autotitles box linetype -1 linewidth 1.000
set samples 400, 400
plot [-10:10] real(sin(x)**besj0(x))