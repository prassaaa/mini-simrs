import PasienController from '@/actions/App/Http/Controllers/PasienController';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type PaginatedData, type Pasien } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { format } from 'date-fns';
import { Eye, Pencil, Plus, Search, Trash2 } from 'lucide-react';
import { useRef } from 'react';
import { useDebouncedCallback } from 'use-debounce';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Data Pasien',
        href: PasienController.index().url,
    },
];

interface Props {
    pasiens: PaginatedData<Pasien>;
    filters: {
        search?: string;
    };
}

export default function Index({ pasiens, filters }: Props) {
    const searchInputRef = useRef<HTMLInputElement>(null);

    const debouncedSearch = useDebouncedCallback((value: string) => {
        router.get(
            PasienController.index().url,
            { search: value || undefined },
            {
                preserveState: true,
                preserveScroll: true,
            }
        );
    }, 500);

    const handleSearchChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const value = e.target.value;
        debouncedSearch(value);
    };

    const handleDelete = (id: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus data pasien ini?')) {
            router.delete(PasienController.destroy(id).url);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Data Pasien" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Data Pasien" />
                    <Link href={PasienController.create().url}>
                        <Button>
                            <Plus className="mr-2 h-4 w-4" />
                            Tambah Pasien
                        </Button>
                    </Link>
                </div>

                {/* Search Bar */}
                <div className="relative w-full max-w-sm">
                    <Search className="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
                    <Input
                        ref={searchInputRef}
                        type="text"
                        placeholder="Cari pasien ( No. RM, Nama, dan Alamat )"
                        defaultValue={filters.search || ''}
                        onChange={handleSearchChange}
                        className="pl-9"
                    />
                </div>

                <div className="rounded-xl border border-sidebar-border/70 bg-card dark:border-sidebar-border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>No</TableHead>
                                <TableHead>No. RM</TableHead>
                                <TableHead>Nama Pasien</TableHead>
                                <TableHead>Tanggal Lahir</TableHead>
                                <TableHead>Jenis Kelamin</TableHead>
                                <TableHead>Alamat</TableHead>
                                <TableHead className="text-right">Aksi</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {pasiens.data.length === 0 ? (
                                <TableRow>
                                    <TableCell colSpan={7} className="text-center">
                                        Tidak ada data pasien
                                    </TableCell>
                                </TableRow>
                            ) : (
                                pasiens.data.map((pasien, index) => (
                                    <TableRow key={pasien.id}>
                                        <TableCell>
                                            {pasiens.from + index}
                                        </TableCell>
                                        <TableCell>{pasien.no_rm}</TableCell>
                                        <TableCell>{pasien.nama_pasien}</TableCell>
                                        <TableCell>
                                            {format(new Date(pasien.tanggal_lahir), 'dd/MM/yyyy')}
                                        </TableCell>
                                        <TableCell>
                                            {pasien.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                                        </TableCell>
                                        <TableCell>
                                            {pasien.alamat.length > 50
                                                ? `${pasien.alamat.substring(0, 50)}...`
                                                : pasien.alamat}
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex justify-end gap-2">
                                                <Link href={PasienController.show(pasien.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Eye className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Link href={PasienController.edit(pasien.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Pencil className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Button
                                                    variant="outline"
                                                    size="sm"
                                                    onClick={() => handleDelete(pasien.id)}
                                                >
                                                    <Trash2 className="h-4 w-4" />
                                                </Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))
                            )}
                        </TableBody>
                    </Table>
                </div>

                {/* Pagination */}
                {pasiens.last_page > 1 && (
                    <div className="flex items-center justify-between">
                        <div className="text-sm text-muted-foreground">
                            Menampilkan {pasiens.from} - {pasiens.to} dari {pasiens.total} data
                        </div>
                        <div className="flex gap-2">
                            {pasiens.links.map((link, index) => (
                                <Link
                                    key={index}
                                    href={link.url || '#'}
                                    preserveScroll
                                    className={`rounded px-3 py-1 text-sm ${
                                        link.active
                                            ? 'bg-primary text-primary-foreground'
                                            : 'bg-muted hover:bg-muted/80'
                                    } ${!link.url ? 'pointer-events-none opacity-50' : ''}`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}

