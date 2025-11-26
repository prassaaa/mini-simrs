import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, Odontogram, Pasien, PaginationLinks, PaginationMeta } from '@/types';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { format } from 'date-fns';
import { id } from 'date-fns/locale';
import { Eye, ArrowLeft, ChevronLeft, ChevronRight, FileText, Activity } from 'lucide-react';

interface Props {
    pasien: Pasien;
    odontograms: {
        data: Odontogram[];
        links: PaginationLinks;
        meta: PaginationMeta;
    };
}

export default function HistoryOdontogram({ pasien, odontograms }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Pasien', href: '/pasien' },
        { title: pasien.nama_pasien, href: `/pasien/${pasien.id}` },
        { title: 'Riwayat Odontogram', href: '#' },
    ];

    const getDMFTotal = (odontogram: Odontogram) => {
        return (odontogram.status_d || 0) + (odontogram.status_m || 0) + (odontogram.status_f || 0);
    };

    const getDMFColor = (total: number) => {
        if (total === 0) return 'bg-green-100 text-green-800';
        if (total <= 3) return 'bg-yellow-100 text-yellow-800';
        if (total <= 6) return 'bg-orange-100 text-orange-800';
        return 'bg-red-100 text-red-800';
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Riwayat Odontogram - ${pasien.nama_pasien}`} />

            <div className="flex h-full flex-1 flex-col gap-6 p-6">
                {/* Header */}
                <div className="flex justify-between items-center">
                    <Link href={`/pasien/${pasien.id}`}>
                        <Button variant="outline">
                            <ArrowLeft className="w-4 h-4 mr-2" />
                            Kembali ke Pasien
                        </Button>
                    </Link>
                </div>

                {/* Pasien Info */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center gap-2">
                            <Activity className="w-5 h-5" />
                            Riwayat Odontogram
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div>
                                <span className="text-muted-foreground">No. RM:</span>
                                <p className="font-medium">{pasien.no_rm}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Nama Pasien:</span>
                                <p className="font-medium">{pasien.nama_pasien}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Jenis Kelamin:</span>
                                <p className="font-medium">{pasien.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Total Pemeriksaan:</span>
                                <p className="font-medium">{odontograms.meta.total}</p>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                {/* Odontogram List */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center gap-2">
                            <FileText className="w-5 h-5" />
                            Daftar Pemeriksaan Odontogram
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        {odontograms.data.length > 0 ? (
                            <>
                                <Table>
                                    <TableHeader>
                                        <TableRow>
                                            <TableHead>Tanggal</TableHead>
                                            <TableHead>No. Kunjungan</TableHead>
                                            <TableHead>Dokter</TableHead>
                                            <TableHead>DMF</TableHead>
                                            <TableHead>Diagnosa</TableHead>
                                            <TableHead className="text-right">Aksi</TableHead>
                                        </TableRow>
                                    </TableHeader>
                                    <TableBody>
                                        {odontograms.data.map((odontogram) => (
                                            <TableRow key={odontogram.id}>
                                                <TableCell>
                                                    {odontogram.kunjungan && format(
                                                        new Date(odontogram.kunjungan.tanggal_kunjungan),
                                                        'dd MMMM yyyy',
                                                        { locale: id }
                                                    )}
                                                </TableCell>
                                                <TableCell>
                                                    <Link
                                                        href={`/kunjungan/${odontogram.kunjungan_id}`}
                                                        className="text-primary hover:underline"
                                                    >
                                                        {odontogram.kunjungan?.no_registrasi_kunjungan}
                                                    </Link>
                                                </TableCell>
                                                <TableCell>
                                                    {odontogram.kunjungan?.dokter?.nama_dokter || '-'}
                                                </TableCell>
                                                <TableCell>
                                                    <div className="flex items-center gap-2">
                                                        <Badge className={getDMFColor(getDMFTotal(odontogram))}>
                                                            D:{odontogram.status_d || 0} M:{odontogram.status_m || 0} F:{odontogram.status_f || 0}
                                                        </Badge>
                                                        <span className="text-sm text-muted-foreground">
                                                            Total: {getDMFTotal(odontogram)}
                                                        </span>
                                                    </div>
                                                </TableCell>
                                                <TableCell className="max-w-xs truncate">
                                                    {odontogram.diagnosa || '-'}
                                                </TableCell>
                                                <TableCell className="text-right">
                                                    <Link href={`/odontogram/${odontogram.id}`}>
                                                        <Button variant="outline" size="sm">
                                                            <Eye className="w-4 h-4 mr-2" />
                                                            Detail
                                                        </Button>
                                                    </Link>
                                                </TableCell>
                                            </TableRow>
                                        ))}
                                    </TableBody>
                                </Table>

                                {/* Pagination */}
                                {odontograms.meta.last_page > 1 && (
                                    <div className="flex items-center justify-between mt-4 pt-4 border-t">
                                        <div className="text-sm text-muted-foreground">
                                            Menampilkan {odontograms.meta.from} - {odontograms.meta.to} dari {odontograms.meta.total} data
                                        </div>
                                        <div className="flex gap-2">
                                            {odontograms.links.prev && (
                                                <Link href={odontograms.links.prev}>
                                                    <Button variant="outline" size="sm">
                                                        <ChevronLeft className="w-4 h-4 mr-1" />
                                                        Prev
                                                    </Button>
                                                </Link>
                                            )}
                                            <span className="px-3 py-1 text-sm bg-muted rounded">
                                                {odontograms.meta.current_page} / {odontograms.meta.last_page}
                                            </span>
                                            {odontograms.links.next && (
                                                <Link href={odontograms.links.next}>
                                                    <Button variant="outline" size="sm">
                                                        Next
                                                        <ChevronRight className="w-4 h-4 ml-1" />
                                                    </Button>
                                                </Link>
                                            )}
                                        </div>
                                    </div>
                                )}
                            </>
                        ) : (
                            <div className="text-center py-12">
                                <Activity className="w-12 h-12 mx-auto text-muted-foreground mb-4" />
                                <h3 className="text-lg font-medium">Belum Ada Data</h3>
                                <p className="text-muted-foreground mt-2">
                                    Pasien ini belum memiliki riwayat pemeriksaan odontogram.
                                </p>
                            </div>
                        )}
                    </CardContent>
                </Card>

                {/* DMF Trend Chart - Simple Version */}
                {odontograms.data.length > 1 && (
                    <Card>
                        <CardHeader>
                            <CardTitle>Tren DMF</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="flex items-end gap-2 h-32">
                                {odontograms.data.slice().reverse().map((odontogram) => {
                                    const total = getDMFTotal(odontogram);
                                    const maxTotal = Math.max(...odontograms.data.map(getDMFTotal), 1);
                                    const height = (total / maxTotal) * 100;

                                    return (
                                        <div key={odontogram.id} className="flex flex-col items-center flex-1 max-w-[60px]">
                                            <div className="w-full flex flex-col items-center">
                                                <span className="text-xs mb-1">{total}</span>
                                                <div
                                                    className={`w-full rounded-t ${getDMFColor(total).replace('100', '500').replace('text-', 'bg-').split(' ')[0]}`}
                                                    style={{ height: `${Math.max(height, 4)}%` }}
                                                />
                                            </div>
                                            <span className="text-xs text-muted-foreground mt-1 truncate w-full text-center">
                                                {odontogram.kunjungan && format(
                                                    new Date(odontogram.kunjungan.tanggal_kunjungan),
                                                    'dd/MM/yy'
                                                )}
                                            </span>
                                        </div>
                                    );
                                })}
                            </div>
                            <div className="flex justify-center gap-4 mt-4 text-xs">
                                <span className="flex items-center gap-1">
                                    <span className="w-3 h-3 bg-red-500 rounded" /> D (Decay)
                                </span>
                                <span className="flex items-center gap-1">
                                    <span className="w-3 h-3 bg-gray-500 rounded" /> M (Missing)
                                </span>
                                <span className="flex items-center gap-1">
                                    <span className="w-3 h-3 bg-blue-500 rounded" /> F (Filled)
                                </span>
                            </div>
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}
