set terminal pngcairo  transparent enhanced font "arial,10" fontscale 1.0 size 500, 350 
set key inside left top vertical Right noreverse enhanced autotitles box linetype -1 linewidth 1.000
set samples 200, 200
plot [-30:20] besj0(x)*0.12e1 with impulses, (x**besj0(x))-2.5 with points