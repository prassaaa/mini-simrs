import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, Odontogram, GigiData } from '@/types';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { OdontogramChart, getKondisiLabel } from '@/components/odontogram';
import { format } from 'date-fns';
import { id } from 'date-fns/locale';
import { Edit, Trash2, ArrowLeft, Printer, Download } from 'lucide-react';
import { router } from '@inertiajs/react';

interface Props {
    odontogram: Odontogram;
    kondisiGigi: Record<string, string>;
}

export default function ShowOdontogram({ odontogram }: Props) {
    const kunjungan = odontogram.kunjungan;

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Kunjungan', href: '/kunjungan' },
        { title: kunjungan?.no_registrasi_kunjungan || '', href: `/kunjungan/${kunjungan?.id}` },
        { title: 'Odontogram', href: '#' },
    ];

    // Convert gigi_list to GigiData record
    const gigiData: Record<string, GigiData> = {};
    odontogram.gigi_list?.forEach((gigi) => {
        gigiData[gigi.nomor_gigi] = {
            kondisi: gigi.kondisi,
            dinding_atas: gigi.dinding_atas,
            dinding_bawah: gigi.dinding_bawah,
            dinding_kiri: gigi.dinding_kiri,
            dinding_kanan: gigi.dinding_kanan,
            dinding_tengah: gigi.dinding_tengah,
            keterangan: gigi.keterangan,
        };
    });

    const handleDelete = () => {
        if (confirm('Apakah Anda yakin ingin menghapus odontogram ini?')) {
            router.delete(`/odontogram/${odontogram.id}`);
        }
    };

    const handlePrint = () => {
        window.print();
    };

    const getOcclusiLabel = (value: string) => {
        const labels: Record<string, string> = {
            'normal_bite': 'Normal Bite',
            'cross_bite': 'Cross Bite',
            'steep_bite': 'Steep Bite',
        };
        return labels[value] || value;
    };

    const getTorusPalatinusLabel = (value: string) => {
        const labels: Record<string, string> = {
            'tidak_ada': 'Tidak Ada',
            'kecil': 'Kecil',
            'sedang': 'Sedang',
            'besar': 'Besar',
            'multiple': 'Multiple',
        };
        return labels[value] || value;
    };

    const getTorusMandibularisLabel = (value: string) => {
        const labels: Record<string, string> = {
            'tidak_ada': 'Tidak Ada',
            'kiri': 'Sisi Kiri',
            'kanan': 'Sisi Kanan',
            'kedua': 'Kedua Sisi',
        };
        return labels[value] || value;
    };

    const getPalatumLabel = (value: string) => {
        const labels: Record<string, string> = {
            'dalam': 'Dalam',
            'sedang': 'Sedang',
            'rendah': 'Rendah',
        };
        return labels[value] || value;
    };

    // Get teeth with issues
    const teethWithIssues = odontogram.gigi_list?.filter(gigi => gigi.kondisi !== 'sou') || [];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Detail Odontogram" />

            <div className="flex h-full flex-1 flex-col gap-6 p-6 print:p-2">
                {/* Action Buttons - Hide on print */}
                <div className="flex justify-between items-center print:hidden">
                    <Link href={`/kunjungan/${kunjungan?.id}`}>
                        <Button variant="outline">
                            <ArrowLeft className="w-4 h-4 mr-2" />
                            Kembali ke Kunjungan
                        </Button>
                    </Link>
                    <div className="flex gap-2">
                        <Button variant="outline" onClick={handlePrint}>
                            <Printer className="w-4 h-4 mr-2" />
                            Cetak
                        </Button>
                        <a href={`/odontogram/${odontogram.id}/export-pdf`}>
                            <Button variant="outline">
                                <Download className="w-4 h-4 mr-2" />
                                Export PDF
                            </Button>
                        </a>
                        <Link href={`/odontogram/${odontogram.id}/edit`}>
                            <Button variant="outline">
                                <Edit className="w-4 h-4 mr-2" />
                                Edit
                            </Button>
                        </Link>
                        <Button variant="destructive" onClick={handleDelete}>
                            <Trash2 className="w-4 h-4 mr-2" />
                            Hapus
                        </Button>
                    </div>
                </div>

                {/* Info Kunjungan */}
                <Card>
                    <CardHeader>
                        <CardTitle>Informasi Kunjungan</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div>
                                <span className="text-muted-foreground">No. Registrasi:</span>
                                <p className="font-medium">{kunjungan?.no_registrasi_kunjungan}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Pasien:</span>
                                <p className="font-medium">{kunjungan?.pasien?.nama_pasien}</p>
                                <p className="text-xs text-muted-foreground">No. RM: {kunjungan?.no_rm}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Dokter:</span>
                                <p className="font-medium">{kunjungan?.dokter?.nama_dokter}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Tanggal Pemeriksaan:</span>
                                <p className="font-medium">
                                    {format(new Date(odontogram.created_at), 'dd MMMM yyyy HH:mm', { locale: id })}
                                </p>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                {/* Pemeriksaan Ekstra Oral */}
                {odontogram.pemeriksaan_ekstra_oral && (
                    <Card>
                        <CardHeader>
                            <CardTitle>Pemeriksaan Ekstra Oral</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <p className="whitespace-pre-wrap">{odontogram.pemeriksaan_ekstra_oral}</p>
                        </CardContent>
                    </Card>
                )}

                {/* Odontogram Chart */}
                <Card>
                    <CardHeader>
                        <CardTitle>Odontogram</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <OdontogramChart
                            gigiData={gigiData}
                            selectedGigi={null}
                            onSelectGigi={() => {}}
                            readOnly
                        />
                    </CardContent>
                </Card>

                {/* Gigi dengan Masalah */}
                {teethWithIssues.length > 0 && (
                    <Card>
                        <CardHeader>
                            <CardTitle>Kondisi Gigi</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-2">
                                {teethWithIssues.map((gigi) => (
                                    <div key={gigi.id} className="p-2 border rounded">
                                        <div className="flex items-center justify-between">
                                            <span className="font-medium">Gigi {gigi.nomor_gigi}</span>
                                            <Badge variant="outline">{getKondisiLabel(gigi.kondisi)}</Badge>
                                        </div>
                                        {gigi.keterangan && (
                                            <p className="text-xs text-muted-foreground mt-1">{gigi.keterangan}</p>
                                        )}
                                    </div>
                                ))}
                            </div>
                        </CardContent>
                    </Card>
                )}

                {/* Pemeriksaan Lainnya */}
                <Card>
                    <CardHeader>
                        <CardTitle>Pemeriksaan Lainnya</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span className="text-muted-foreground">Occlusi:</span>
                                <p className="font-medium">{getOcclusiLabel(odontogram.occlusi)}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Torus Palatinus:</span>
                                <p className="font-medium">{getTorusPalatinusLabel(odontogram.torus_palatinus)}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Torus Mandibularis:</span>
                                <p className="font-medium">{getTorusMandibularisLabel(odontogram.torus_mandibularis)}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Palatum:</span>
                                <p className="font-medium">{getPalatumLabel(odontogram.palatum)}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Diastema:</span>
                                <p className="font-medium">{odontogram.diastema ? 'Ada' : 'Tidak Ada'}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Gigi Anomali:</span>
                                <p className="font-medium">{odontogram.gigi_anomali ? 'Ada' : 'Tidak Ada'}</p>
                            </div>
                        </div>

                        {/* DMF Status */}
                        <div className="grid grid-cols-3 gap-4 mt-4 pt-4 border-t">
                            <div className="text-center p-3 bg-red-50 rounded">
                                <span className="text-2xl font-bold text-red-600">{odontogram.status_d}</span>
                                <p className="text-sm text-muted-foreground">D (Decay)</p>
                            </div>
                            <div className="text-center p-3 bg-gray-50 rounded">
                                <span className="text-2xl font-bold text-gray-600">{odontogram.status_m}</span>
                                <p className="text-sm text-muted-foreground">M (Missing)</p>
                            </div>
                            <div className="text-center p-3 bg-green-50 rounded">
                                <span className="text-2xl font-bold text-green-600">{odontogram.status_f}</span>
                                <p className="text-sm text-muted-foreground">F (Filled)</p>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                {/* Diagnosa & Planning */}
                <Card>
                    <CardHeader>
                        <CardTitle>Diagnosa & Planning</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {odontogram.hasil_pemeriksaan_penunjang && (
                                <div>
                                    <span className="text-sm text-muted-foreground">Hasil Pemeriksaan Penunjang:</span>
                                    <p className="whitespace-pre-wrap">{odontogram.hasil_pemeriksaan_penunjang}</p>
                                </div>
                            )}
                            {odontogram.diagnosa && (
                                <div>
                                    <span className="text-sm text-muted-foreground">Diagnosa:</span>
                                    <p className="whitespace-pre-wrap">{odontogram.diagnosa}</p>
                                </div>
                            )}
                            {odontogram.planning && (
                                <div>
                                    <span className="text-sm text-muted-foreground">Planning / Rencana:</span>
                                    <p className="whitespace-pre-wrap">{odontogram.planning}</p>
                                </div>
                            )}
                            {odontogram.edukasi && (
                                <div>
                                    <span className="text-sm text-muted-foreground">Edukasi:</span>
                                    <p className="whitespace-pre-wrap">{odontogram.edukasi}</p>
                                </div>
                            )}
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
